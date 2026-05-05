<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $casts = [
    'required_skills' => 'array',
    'roadmap' => 'array',
];
    protected $fillable = [
    'user_id',
    'career_name',
    'description',
    'required_skills',
    'roadmap',
    'why_fit'
];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
