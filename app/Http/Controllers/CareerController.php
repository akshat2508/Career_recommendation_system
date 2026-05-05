<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Interest;
use App\Services\AIService;
use App\Models\Recommendation;

class CareerController extends Controller
{
    public function create()
    {
        return view('profile'); // your form page
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

        $data = [
            'skills' => $request->skills,
            'interests' => $request->interests,
            'cgpa' => $request->cgpa
        ];

        $response = $ai->getCareerRecommendations($data);

        $content = $response['choices'][0]['message']['content'] ?? '{}';
        $content = trim($content);

// remove markdown if exists
$content = str_replace(['```json', '```'], '', $content);

// find first { and last }
$start = strpos($content, '{');
$end = strrpos($content, '}');

$jsonString = ($start !== false && $end !== false)
    ? substr($content, $start, $end - $start + 1)
    : '{}';

        // 🔥 Extract JSON safely
        preg_match('/\{.*\}/s', $content, $matches);
        $jsonString = $matches[0] ?? '{}';

        // 🔥 Decode
        $parsed = json_decode($jsonString, true);

        // 🔥 Debug if failed
        if (!$parsed) {
            dd("JSON FAILED", $content);
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
}
