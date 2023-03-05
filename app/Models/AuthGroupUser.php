<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthGroupUser extends Model
{
    use HasFactory;

    protected $table = 'auth_group_user';

    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(AuthGroup::class, 'group_id');
    }

    public function fromGoogleAccount($googleAccount)
    {
        $this->user_id = $googleAccount->user_id;
        $this->group_id = AuthGroup::where('name', 'User')->first()->id;
        $this->save();
    }

    public function fromUser($user)
    {
        $this->user_id = $user->id;
        $this->group_id = AuthGroup::where('name', 'User')->first()->id;
        $this->save();
    }

    public function fromAdmin($user)
    {
        $this->user_id = $user->id;
        $this->group_id = AuthGroup::where('name', 'Admin')->first()->id;
        $this->save();
    }
}
