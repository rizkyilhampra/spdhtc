<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapping = [
            'Virus Kuning (Gemini Virus)' => [
                'sekitar tulang daun menebal berwarna hijau tua dan daun berwarna kuning',
                'tulang daun menebal dan daun menggulung ke atas',
                'daun mengecil dan berwarna kuning terang',
                'tanaman kerdil dan tidak berbuah',
            ],
            // Tambah penyakit lain di sini bila perlu...
        ];

        DB::transaction(function () use ($mapping) {
            foreach ($mapping as $penyakitName => $gejalaNames) {
                $penyakit = Penyakit::where('name', $penyakitName)->first();
                if (! $penyakit) {
                    // Lewatkan jika belum ada (pastikan urutan seeding benar)
                    continue;
                }

                $gejalas = Gejala::whereIn('name', $gejalaNames)->get(['id', 'name']);

                foreach ($gejalas as $g) {
                    Rule::firstOrCreate([
                        'penyakit_id' => $penyakit->id,
                        'gejala_id' => $g->id,
                    ]);
                }
            }
        });
    }
}
