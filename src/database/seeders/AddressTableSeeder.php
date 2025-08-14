<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('email', 'test1@example.com')->first();
        $user2 = User::where('email', 'test2@example.com')->first();
        $user3 = User::where('email', 'test3@example.com')->first();

        $address = [
            [
                'user_id' => $user1->id,
                'post_code' => '123-4567',
                'address' => '東京都渋谷区千駄ヶ谷',
                'building' => '千駄ヶ谷マンション',
            ],
            [
                'user_id' => $user2->id,
                'post_code' => '123-4567',
                'address' => '東京都渋谷区千駄ヶ谷',
                'building' => '千駄ヶ谷マンション',
            ],
            [
                'user_id' => $user3->id,
                'post_code' => '123-4567',
                'address' => '東京都渋谷区千駄ヶ谷',
                'building' => '千駄ヶ谷マンション',
            ],
        ];
        DB::table('addresses')->insert($address);
    }
}
