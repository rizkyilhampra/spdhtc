<?php

namespace Database\Seeders;

use App\Models\Penyakit as ModelsPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Penyakit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //name
        //reason
        //solution
        //image

        ModelsPenyakit::create([
            'name' => 'Penyakit 1',
            'reason' => 'Penyebab 1',
            'solution' => 'Solusi 1',
            'image' => 'image1.jpg',
        ]);
    }
}
