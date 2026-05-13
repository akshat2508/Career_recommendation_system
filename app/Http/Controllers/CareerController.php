<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Interest;
use App\Services\AIService;
use App\Models\Recommendation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ResumeAnalysis;
use App\Services\ResumeParserService;

$careerPersonalityMap = [
    'devops engineer' => ['analytical', 'structured'],
    'cloud solutions architect' => ['analytical', 'structured'],
    'ui/ux designer' => ['creative'],
    'product manager' => ['social', 'analytical'],
    'data scientist' => ['analytical'],
];
class CareerController extends Controller
{
    public function create()
    {
        return view('profile'); // your form page
    }
    // 🔥 Personality Title Mapping
    private function getPersonalityTitle($traits)
    {
        $map = [
            'analytical_structured' => 'System Thinker',
            'structured_analytical' => 'System Thinker',

            'creative_social' => 'Creative Collaborator',
            'social_creative' => 'Creative Collaborator',

            'analytical_creative' => 'Innovative Problem Solver',
            'creative_analytical' => 'Innovative Problem Solver',

            'social_structured' => 'Organized Leader',
            'structured_social' => 'Organized Leader',
        ];

        $key = implode('_', $traits);

        return $map[$key] ?? 'Balanced Individual';
    }
    public function store(Request $request)
    {
        $user = auth()->user();

        // Save profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['cgpa', 'branch', 'education_level'])
        );

        // Skills
        $skills = explode(',', $request->skills);
        foreach ($skills as $skillName) {
            $skill = Skill::firstOrCreate(['name' => trim($skillName)]);
            $user->skills()->syncWithoutDetaching([$skill->id]);
        }

        // Interests
        $interests = explode(',', $request->interests);
        foreach ($interests as $interestName) {
            $interest = Interest::firstOrCreate(['name' => trim($interestName)]);
            $user->interests()->syncWithoutDetaching([$interest->id]);
        }

        // 🔥 AI PART
        $ai = new AIService();
        $personality = auth()->user()->profile->personality ?? [];
        // 🔥 Convert personality scores → top traits
        arsort($personality); // sort highest first
        $topTraits = array_keys(array_slice($personality, 0, 2));

        // Convert to readable string
        $personalityText = implode(', ', $topTraits);
        $personalityTitle = $this->getPersonalityTitle($topTraits);

        $data = [
            'skills' => $request->skills,
            'interests' => $request->interests,
            'cgpa' => $request->cgpa,
            'personality' => $personalityText,
            'personality_title' => $personalityTitle

        ];
        $data['instruction'] = "Explain clearly why each career matches the personality type: $personalityTitle ($personalityText)";

        $response = $ai->getCareerRecommendations($data);

        $content = $response['choices'][0]['message']['content'] ?? '{}';
       $content = trim($content);

// remove markdown if exists
$content = str_replace(['```json', '```'], '', $content);

// 🔥 safer extraction
if (preg_match('/\{.*\}/s', $content, $matches)) {
    $jsonString = $matches[0];
} else {
    $jsonString = '{}';
}

        // 🔥 Decode
        $parsed = json_decode($jsonString, true);

        // 🔥 Debug if failed
        if (!$parsed) {
            dd("JSON FAILED", $jsonString);
        }

        // 🔥 Normalize key (important)
        $careers = $parsed['careers'] ?? $parsed['career'] ?? null;

        if (!$careers) {
            dd("NO CAREERS KEY", $parsed);
        }

        // 🔥 Save
        foreach ($careers as $career) {
            Recommendation::create([
                'user_id' => $user->id,
                'career_name' => $career['title'] ?? 'Unknown',
                'description' => $career['description'] ?? '',
                'required_skills' => $career['required_skills'] ?? [],
                'roadmap' => $career['roadmap'] ?? [],
                'why_fit' => $career['why_fit'] ?? '',
            ]);
        }
        return redirect('/dashboard')->with('success', 'Profile + AI done!');
    }

    public function show($id)
    {
        $career = Recommendation::findOrFail($id);

        if ($career->user_id !== auth()->id()) {
            abort(403);
        }

        $userSkills = auth()->user()->skills->pluck('name')->map(function ($s) {
            return strtolower(trim($s));
        })->toArray();

        $required = collect($career->required_skills ?? [])
            ->map(fn($s) => strtolower(trim($s)))
            ->toArray();

        $matched = array_intersect($required, $userSkills);

        $matchScore = count($required) > 0
            ? round((count($matched) / count($required)) * 100)
            : 0;

        return view('career.show', compact('career', 'userSkills', 'matchScore', 'required'));
    }

    public function exportPdf($id)
    {
        $career = Recommendation::findOrFail($id);

        // security check
        if ($career->user_id !== auth()->id()) {
            abort(403);
        }

        // normalize user skills (for gap + match in PDF)
        $userSkills = auth()->user()->skills
            ->pluck('name')
            ->map(fn($s) => strtolower(trim($s)))
            ->toArray();

        $required = collect($career->required_skills ?? [])
            ->map(fn($s) => strtolower(trim($s)))
            ->toArray();

        $matched = array_intersect($required, $userSkills);

        $matchScore = count($required) > 0
            ? round((count($matched) / count($required)) * 100)
            : 0;

        $missing = array_filter($required, fn($s) => !in_array($s, $userSkills));

        $pdf = Pdf::loadView('career.pdf', compact(
            'career',
            'matchScore',
            'missing'
        ));

        return $pdf->download('career-report-' . $career->id . '.pdf');
    }
    public function chat(Request $request)
    {
        $message = strtolower($request->message);

        $user = auth()->user();

        $skills = $user->skills->pluck('name')->join(', ');
        $interests = $user->interests->pluck('name')->join(', ');

        // 🔥 RULE-BASED INTENT HANDLING

        if (str_contains($message, 'roadmap')) {
            $intent = "Explain a step-by-step roadmap clearly.";
        } elseif (str_contains($message, 'skills')) {
            $intent = "List important skills and explain them briefly.";
        } elseif (str_contains($message, 'career')) {
            $intent = "Suggest suitable careers with reasoning.";
        } elseif (str_contains($message, 'start')) {
            $intent = "Explain how to start from beginner level.";
        } else {
            $intent = "Answer like a helpful career mentor.";
        }

        $prompt = "
User Profile:
Skills: $skills
Interests: $interests

User Question: {$request->message}

Instruction: $intent

Answer clearly, structured, and practical. Avoid long paragraphs.
";

        $ai = new \App\Services\AIService();

        $response = $ai->getCareerRecommendations([
            'custom_prompt' => $prompt
        ]);

        $reply = $response['choices'][0]['message']['content'] ?? 'No response';

        return response()->json(['reply' => $reply]);
    }

    public function personalityForm()
    {
        return view('personality');
    }

    public function personalitySubmit(Request $request)
    {
        $answers = $request->answers;

        $scores = [];

        foreach ($answers as $type => $value) {
            $scores[$type] = (int) $value;
        }

        Profile::updateOrCreate(
            ['user_id' => auth()->id()],
            ['personality' => $scores]
        );

        return redirect()->route('career.create')->with('success', 'Personality saved!');
    }


    public function resumeForm()
{
    return view('career.resume');
}

public function analyzeResume(
    Request $request,
    ResumeParserService $parser,
    AIService $aiService
)
{
    $request->validate([
        'resume' => 'required|mimes:pdf,docx|max:5120'
    ]);

    $file = $request->file('resume');

    $path = $file->store('resumes', 'public');

    $resumeText = $parser->extractText($file);
    // dd($resumeText);

    $analysis = $aiService->analyzeResume($resumeText);

    $resume = ResumeAnalysis::create([

        'user_id' => auth()->id(),

        'resume_path' => $path,

        'resume_text' => $resumeText,

        'ats_score' => $analysis['ats_score'] ?? 0,

        'detected_skills' =>
            $analysis['detected_skills'] ?? [],

        'missing_skills' =>
            $analysis['missing_skills'] ?? [],

        'career_matches' =>
            $analysis['career_matches'] ?? [],

        'strengths' =>
            $analysis['strengths'] ?? [],

        'weaknesses' =>
            $analysis['weaknesses'] ?? [],

        'ai_analysis' => json_encode($analysis),
    ]);

    return view(
        'career.resume-result',
        compact('resume', 'analysis')
    );
}
}
