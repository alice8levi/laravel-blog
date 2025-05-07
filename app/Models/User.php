<?php

namespace App\Models;
//38 https://laravel.su/index.php/docs/11.x/verification
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 72
use Illuminate\Contracts\Auth\CanResetPassword;
//74?
use Illuminate\Auth\Passwords\CanResetPassword as ResetTrait;


// 39 implements MustVerifyEmail 40 в usercontroller 
// 73, CanResetPassword
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    // 75? 76 web.php
    use HasFactory, Notifiable, ResetTrait;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
