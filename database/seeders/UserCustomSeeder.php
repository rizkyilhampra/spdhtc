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
                'email' => 'admin@spdhtc.tech',
                'password' => bcrypt(env('ADMIN_ACCOUNT_PASSWORD', '12345678')), //12345678
            ],
            [
                'name' => 'user',
                'email' => 'user@spdhtc.tech',
                'password' => bcrypt(env('USER_ACCOUNT_PASSWORD', '12345678')), //12345678
            ],
        ];

        foreach ($data as $user) {
            User::factory()->create($user);
        }
    }
}
