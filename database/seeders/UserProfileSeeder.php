<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profession = ['Developer', 'Designer', 'Manager', 'Architect'];

        for ($i = 1; $i <= User::count(); $i++) {
            \App\Models\UserProfile::create([
                'user_id' => $i,
                'address' => Factory::create()->address,
                'city' => 'Anytown',
                'province' => 'BC',
                'profession' => $profession[rand(0, 3)],
            ]);
        }
    }
}
