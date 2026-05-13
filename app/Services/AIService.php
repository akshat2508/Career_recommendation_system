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
'content' => '
You are an expert AI career mentor.

Rules:
- Keep responses short and clean
- Use simple formatting
- Never generate markdown tables
- Use headings and bullet points only
- Keep paragraphs under 2 lines
- Highlight important points
- Be conversational and practical
- Give actionable advice
- Avoid overly long explanations

Format responses like:

## Main Answer
Short explanation

## Pros
- Point
- Point

## Cons
- Point
- Point

## Recommendation
Final practical advice
'                ],
                [
                    'role' => 'user',
'content' => $prompt . '

Respond ONLY in clean HTML.
Use:
<h2>, <p>, <ul>, <li>, <strong>

Do NOT use markdown.
Do NOT use tables.
'                ]
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

public function analyzeResume($resumeText)
{
$prompt = "
You are an ATS resume analyzer.

Analyze the resume and return VALID JSON ONLY.

No markdown.
No explanations.
No extra text.

JSON FORMAT:

{
  \"ats_score\": 0,
  \"detected_skills\": [],
  \"missing_skills\": [],
  \"strengths\": [],
  \"weaknesses\": [],
  \"career_matches\": [
    {
      \"role\": \"\",
      \"match_percentage\": 0
    }
  ],
  \"improvements\": []
}

Resume Content:
{$resumeText}
";
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post(
        'https://api.groq.com/openai/v1/chat/completions',
        [

            'model' => 'openai/gpt-oss-20b',

            'messages' => [
                [
                    'role' => 'system',
                    'content' =>
                        'You are a professional ATS AI. Return ONLY raw JSON.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],

            'temperature' => 0.3,
        ]
    );

    $content =
        $response['choices'][0]['message']['content'] ?? null;

    if (!$content) {

        return [
            'ats_score' => 0,
            'detected_skills' => [],
            'missing_skills' => [],
            'strengths' => [],
            'weaknesses' => [],
            'career_matches' => [],
            'improvements' => [],
        ];
    }

    // 🔥 CLEAN JSON
    $content = trim($content);
    // dd($content);

    $content = str_replace('```json', '', $content);
    $content = str_replace('```', '', $content);

    $decoded = json_decode($content, true);

    if (!$decoded) {

        return [
            'ats_score' => 0,
            'detected_skills' => [],
            'missing_skills' => [],
            'strengths' => [],
            'weaknesses' => [],
            'career_matches' => [],
            'improvements' => [],
        ];
    }

    return $decoded;
}
}