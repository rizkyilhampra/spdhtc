<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'name' => 'Admin',
                'description' => 'Administrators',
            ],
            [
                'name' => 'User',
                'description' => 'Users',
            ],
        ];

        foreach ($groups as $group) {
            \App\Models\AuthGroup::create($group);
        }
    }
}
