<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UserSeeder::class, //unlink this line if you want to use User Seeder with Factory
            UserCustomSeeder::class,
            AuthGroupSeeder::class,
            AuthGroupUserSeeder::class,
            UserProfileSeeder::class,
            Penyakit::class,
            Gejala::class,
            Rule::class,
        ]);
    }
}
