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
                'email' => 'user1@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('password')
            ]
        ];
        DB::table('users')->insert($users);
    }
}
