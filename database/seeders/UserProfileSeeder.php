<?php

namespace Database\Seeders;

use App\Models\User;
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
        for ($i = 1; $i <= User::count(); $i++) {
            \App\Models\UserProfile::create([
                'user_id' => $i,
                'address' => '123 Main St.',
                'city' => 'Anytown',
                'province' => 'BC',
                'profession' => 'Developer',
            ]);
        }
    }
}
