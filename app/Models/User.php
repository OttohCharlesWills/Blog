<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // ✅ add this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // ✅ implement it
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',                 // added
        'focus',                // added
        'bio',                  // added
        'avatar',               // added
        'is_active',            // added
        'onboarding_completed', // added
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
