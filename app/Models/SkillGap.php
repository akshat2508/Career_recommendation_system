<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillGap extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'career_name',
    'missing_skills'
];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
