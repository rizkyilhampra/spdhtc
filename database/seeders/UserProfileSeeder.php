<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
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
        $profession = ['Petani', 'Lainnya'];

        for ($i = 1; $i <= User::count(); $i++) {
            \App\Models\UserProfile::create([
                'user_id' => $i,
                'address' => Factory::create()->address,
                'city' => 'Anytown',
                'province' => 'BC',
                'profession' => $profession[rand(0, 1)],
            ]);
        }

        UserProfile::where('user_id', 12)->update([
            'province' => 13,
            'city' => 144
        ]);
        UserProfile::where('user_id', 13)->update([
            'province' => 13,
            'city' => 144
        ]);
    }
}
