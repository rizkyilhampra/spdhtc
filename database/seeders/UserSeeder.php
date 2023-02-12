<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        User::factory()->create([
            'name' => 'Rizky Ilham',
            'email' => 'rizkyilhamp16@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
        ]);
    }
}
