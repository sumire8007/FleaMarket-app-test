<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;


class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('email', 'demo1@example.com')->first();
        $user2 = User::where('email', 'demo2@example.com')->first();
        $user3 = User::where('email', 'demo3@example.com')->first();
        $watch = Item::where('item_name', '腕時計')->first();
        $mic = Item::where('item_name','マイク')->first();

        $messages = [
            [
                'user_id' => $user3->id,
                'item_id' => $watch->id,
                'message' => '値下げ希望です。'
            ],
            [
                'user_id' => $user3->id,
                'item_id' => $mic->id,
                'message' => '値下げ希望です。'
            ],
            [
                'user_id' => $user1->id,
                'item_id' => $mic->id,
                'message' => '購入可能ですか？'
            ],
            [
                'user_id' => $user2->id,
                'item_id' => $watch->id,
                'message' => '購入可能ですか？'
            ],
        ];
        DB::table('chats')->insert($messages);
    }
}
