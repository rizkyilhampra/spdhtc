<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NextFirstGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rule::where('penyakit_id', 1)->update([
            'next_first_gejala_id' => 5,
        ]);

        Rule::where('penyakit_id', 2)->update([
            'next_first_gejala_id' => 9,
        ]);

        Rule::where('penyakit_id', 3)->update([
            'next_first_gejala_id' => 13,
        ]);

        Rule::where('penyakit_id', 4)->update([
            'next_first_gejala_id' => 17,
        ]);

        Rule::where('penyakit_id', 5)->update([
            'next_first_gejala_id' => 21,
        ]);

        Rule::where('penyakit_id', 6)->update([
            'next_first_gejala_id' => 24,
        ]);
    }
}
