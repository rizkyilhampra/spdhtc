<?php

namespace Database\Seeders;

use App\Models\Gejala as ModelsGejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Gejala extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //prefix
        //name
        //image

        ModelsGejala::create([
            'name' => 'Gejala 1',
            'image' => 'image1.jpg',
        ]);
    }
}