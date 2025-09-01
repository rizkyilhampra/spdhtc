<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gejala;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'name'  => 'sekitar tulang daun menebal berwarna hijau tua dan daun berwarna kuning',
                'image' => '2010365565.jpg',
            ],
            [
                'name'  => 'tulang daun menebal dan daun menggulung ke atas',
                'image' => '1677054521.jpg',
            ],
            [
                'name'  => 'daun mengecil dan berwarna kuning terang',
                'image' => '1393673814.jpg',
            ],
            [
                'name'  => 'tanaman kerdil dan tidak berbuah',
                'image' => '312554642.jpg',
            ],
        ];

        foreach ($rows as $row) {
            Gejala::updateOrCreate(
                ['name' => $row['name']],
                ['image' => $row['image']]
            );
        }
    }
}
