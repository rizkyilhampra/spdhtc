<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at',
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

    public function googleAuth()
    {
        return $this->hasOne(GoogleAuth::class);
    }

    //return avatar if user has google avatar, else return default avatar
    public function getAvatarAttribute()
    {
        return $this->googleAuth->avatar ?? 'https://ui-avatars.com/api/?name=' . $this->name;
    }

    public function groups()
    {
        return $this->belongsToMany(AuthGroup::class, 'auth_group_user', 'user_id', 'group_id');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function diagnosa()
    {
        return $this->hasMany(Diagnosa::class);
    }
}
