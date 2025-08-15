<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'ユーザー1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2025-08-01 09:00:00',
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2025-08-01 09:00:00'
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2025-08-01 09:00:00'
            ]

        ];
        DB::table('users')->insert($users);
    }
}
