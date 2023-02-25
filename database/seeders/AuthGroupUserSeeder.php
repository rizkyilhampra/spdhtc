<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthGroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= User::count(); $i++) {
            \App\Models\AuthGroupUser::create([
                'user_id' => $i,
                'group_id' => 2,
            ]);
        }
    }
}
