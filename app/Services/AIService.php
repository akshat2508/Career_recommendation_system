<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function getCareerRecommendations($data)
    {
        $prompt = "
User Profile:
Skills: {$data['skills']}
Interests: {$data['interests']}
CGPA: {$data['cgpa']}

Return ONLY valid JSON (no text outside JSON):

{
  \"careers\": [
    {
      \"title\": \"Career Name\",
      \"description\": \"Short description\",
      \"required_skills\": [\"skill1\", \"skill2\", \"skill3\"],
      \"roadmap\": [
        \"Step 1\",
        \"Step 2\",
        \"Step 3\"
      ]
    }
  ]
}
";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [

            // ✅ USE THIS MODEL (from your screenshot)
            'model' => 'openai/gpt-oss-20b',

            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a career guidance AI. Give structured and clean answers.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
        ]);

        return $response->json();
    }
}