<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
   public function getCareerRecommendations($data)
{
    // 🔥 Detect mode
    $isChat = isset($data['custom_prompt']);

    // 🎯 CHAT MODE
    if ($isChat) {
        $prompt = $data['custom_prompt'];

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [

            'model' => 'openai/gpt-oss-20b',

            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful career mentor. Give clear, concise answers.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
        ])->json();
    }

    // 🎯 CAREER MODE (JSON)
    $prompt = "
User Profile:
Skills: {$data['skills']}
Interests: {$data['interests']}
CGPA: {$data['cgpa']}
Personality traits: {$data['personality']}


Return ONLY valid JSON (no text outside JSON):

{
  \"careers\": [
    {
      \"title\": \"Career Name\",
      \"description\": \"Short description\",
      \"required_skills\": [\"skill1\", \"skill2\", \"skill3\"],
      \"why_fit\": \"Explain why this career suits THIS user specifically\",
      \"roadmap\": [
        \"Step 1\",
        \"Step 2\",
        \"Step 3\"
      ]
    }
  ]
}
";

    return Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.groq.com/openai/v1/chat/completions', [

        'model' => 'openai/gpt-oss-20b',

        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a career guidance AI. Return strictly JSON.'
            ],
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ],
    ])->json();
}
}