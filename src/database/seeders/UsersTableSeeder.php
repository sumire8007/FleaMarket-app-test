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
                'name' => 'demo1',
                'email' => 'demo1@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'demo2@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'demo3@example.com',
                'password' => Hash::make('password')
            ]

        ];
        DB::table('users')->insert($users);
    }
}
