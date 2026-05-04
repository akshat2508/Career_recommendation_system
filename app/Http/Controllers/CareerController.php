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

        $content = $response['choices'][0]['message']['content'] ?? 'No response';

Recommendation::create([
    'user_id' => $user->id,
    'career_name' => 'AI Generated',
    'description' => $content,
]);
        return redirect('/dashboard')->with('success', 'Profile + AI done!');
    }
}