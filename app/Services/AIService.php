<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function getCareerRecommendations($data)
    {
        $prompt = "User has skills: {$data['skills']}, interests: {$data['interests']}, CGPA: {$data['cgpa']}.
        Suggest 3 career paths with required skills and roadmap in clean readable format.";

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