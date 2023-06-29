<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /**
         * Create Custom User with Factory
         */
        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('12345678'),
        // ]);
        // User::factory()->create([
        //     'name' => 'user',
        //     'email' => 'user@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('12345678'),
        // ]);
        // User::factory()->create([
        //     'name' => 'user2',
        //     'email' => 'user2@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('12345678'),
        // ]);

        /**
         * Create Custom User with Model
         */
        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@spdhtc.tech',
                'email_verified_at' => now(),
                'password' => bcrypt(env('ADMIN_ACCOUNT_PASSWORD', '12345678'))
            ],
        );

        User::create([
            'name' => 'user',
            'email' => 'user@spdhtc.tech',
            'email_verified_at' => now(),
            'password' => bcrypt(env('USER_ACCOUNT_PASSWORD', '12345678'))
        ]);
    }
}
