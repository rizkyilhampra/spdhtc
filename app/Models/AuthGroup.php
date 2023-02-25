<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthGroup extends Model
{
    use HasFactory;

    protected $table = 'auth_group';

    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'auth_group_user', 'group_id', 'user_id');
    }
}
