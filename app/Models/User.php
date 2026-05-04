<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Skill;
use App\Models\Interest;
use App\Models\Recommendation;
use App\Models\SkillGap;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
public function skills()
{
    return $this->belongsToMany(Skill::class, 'user_skills');
}

public function interests()
{
    return $this->belongsToMany(Interest::class, 'user_interests');
}

public function recommendations()
{
    return $this->hasMany(Recommendation::class);
}

public function skillGaps()
{
    return $this->hasMany(SkillGap::class);
}
public function profile()
{
    return $this->hasOne(Profile::class);
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
