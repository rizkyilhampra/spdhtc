<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    protected $fillable = [
        'name',
        'reason',
        'solution',
        'image',
    ];

    public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'rule', 'penyakit_id', 'gejala_id');
    }

    public function rule()
    {
        return $this->hasMany(Rule::class);
    }

    public function diagnosa()
    {
        return $this->hasMany(Diagnosa::class);
    }
}
