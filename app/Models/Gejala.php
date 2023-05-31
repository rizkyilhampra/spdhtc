<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';

    protected $fillable = [
        'name',
        'image',
    ];

    public function penyakit()
    {
        return $this->belongsToMany(Penyakit::class, 'rule', 'gejala_id', 'penyakit_id');
    }
}
