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
                'chat_flag' => $user3->id . '_' . $watch->id,
                'message' => '値下げ希望です。',
                'created_at' => '2025-08-01 09:00:00',
            ],
            [
                'user_id' => $user3->id,
                'item_id' => $mic->id,
                'chat_flag' => $user3->id . '_' . $mic->id,
                'message' => '値下げ希望です。',
                'created_at' => '2025-08-01 09:00:00',

            ],
            [
                'user_id' => $user1->id,
                'item_id' => $mic->id,
                'chat_flag' => $user1->id . '_' . $mic->id,
                'message' => '購入可能ですか？',
                'created_at' => '2025-08-01 09:00:00',
            ],
            [
                'user_id' => $user2->id,
                'item_id' => $watch->id,
                'chat_flag' => $user2->id . '_' . $watch->id,
                'message' => '購入可能ですか？',
                'created_at' => '2025-08-02 09:00:00',
            ],
        ];
        DB::table('chats')->insert($messages);
    }
}
