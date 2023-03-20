<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule as ModelsRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Rule extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //penyakit_id
        //gejala_id

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 1)->first()->id,
            'gejala_id' => Gejala::where('id', 1)->first()->id
        ]);
    }
}
