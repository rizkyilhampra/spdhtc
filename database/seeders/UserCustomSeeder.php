<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
            ],
        ];

        foreach ($data as $user) {
            User::factory()->create($user);
        }
    }
}
