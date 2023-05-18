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

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 1)->first()->id,
            'gejala_id' => Gejala::where('id', 2)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 1)->first()->id,
            'gejala_id' => Gejala::where('id', 3)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 1)->first()->id,
            'gejala_id' => Gejala::where('id', 4)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 2)->first()->id,
            'gejala_id' => Gejala::where('id', 5)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 2)->first()->id,
            'gejala_id' => Gejala::where('id', 6)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 2)->first()->id,
            'gejala_id' => Gejala::where('id', 7)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 2)->first()->id,
            'gejala_id' => Gejala::where('id', 8)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 3)->first()->id,
            'gejala_id' => Gejala::where('id', 9)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 3)->first()->id,
            'gejala_id' => Gejala::where('id', 10)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 3)->first()->id,
            'gejala_id' => Gejala::where('id', 11)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 3)->first()->id,
            'gejala_id' => Gejala::where('id', 12)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 4)->first()->id,
            'gejala_id' => Gejala::where('id', 13)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 4)->first()->id,
            'gejala_id' => Gejala::where('id', 14)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 4)->first()->id,
            'gejala_id' => Gejala::where('id', 15)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 4)->first()->id,
            'gejala_id' => Gejala::where('id', 16)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 5)->first()->id,
            'gejala_id' => Gejala::where('id', 17)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 5)->first()->id,
            'gejala_id' => Gejala::where('id', 18)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 5)->first()->id,
            'gejala_id' => Gejala::where('id', 19)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 5)->first()->id,
            'gejala_id' => Gejala::where('id', 20)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 6)->first()->id,
            'gejala_id' => Gejala::where('id', 21)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 6)->first()->id,
            'gejala_id' => Gejala::where('id', 22)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 6)->first()->id,
            'gejala_id' => Gejala::where('id', 23)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 7)->first()->id,
            'gejala_id' => Gejala::where('id', 24)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 7)->first()->id,
            'gejala_id' => Gejala::where('id', 25)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 7)->first()->id,
            'gejala_id' => Gejala::where('id', 26)->first()->id
        ]);

        ModelsRule::create([
            'penyakit_id' =>  Penyakit::where('id', 7)->first()->id,
            'gejala_id' => Gejala::where('id', 27)->first()->id
        ]);
    }
}
