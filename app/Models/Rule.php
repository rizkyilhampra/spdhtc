<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rule';

    protected $fillable = [
        'penyakit_id',
        'gejala_id',
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }

    public function nextGejala()
    {
        return $this->belongsTo(Gejala::class, 'next_first_gejala_id');
    }
}
