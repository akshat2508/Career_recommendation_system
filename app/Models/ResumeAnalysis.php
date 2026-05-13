<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resume_path',
        'resume_text',
        'ats_score',
        'detected_skills',
        'missing_skills',
        'career_matches',
        'strengths',
        'weaknesses',
        'ai_analysis',
    ];

    protected $casts = [
        'detected_skills' => 'array',
        'missing_skills' => 'array',
        'career_matches' => 'array',
        'strengths' => 'array',
        'weaknesses' => 'array',
    ];
}