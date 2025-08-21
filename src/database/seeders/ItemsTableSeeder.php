<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'watch.jpg' => public_path('img/watch.jpg'),
            'hdd.jpg' => public_path('img/HDDHardDisk.jpg'),
            'onion.jpg' => public_path('img/Onion.jpg'),
            'shoes.jpg' => public_path('img/LeatherShoesProductPhoto.jpg'),
            'notePc.jpg' => public_path('img/notePC.jpg'),
            'mic.jpg' => public_path('img/MusicMic.jpg'),
            'bag.jpg' => public_path('img/Pursefashionpocket.jpg'),
            'tumbler.jpg' => public_path('img/Tumbler+souvenir.jpg'),
            'coffeeMill.jpg' => public_path('img/Waitress+with+Coffee+Grinder.jpg'),
            'makeupSet.jpg' => public_path('img/makeupset.jpg'),
        ];
        $user1 = User::where('email', 'test1@example.com')->first();
        $user2 = User::where('email', 'test2@example.com')->first();
        foreach ($images as $filename => $url) {
            $imageContents = file_get_contents($url);
            Storage::put("public/items/{$filename}", $imageContents);
        }
        $items = [
            [
                'user_id' => $user1->id,
                'item_name' => '腕時計',
                'price' => '15000',
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'item_img' => 'items/watch.jpg',
                'condition' => '良好',
                'brand' => 'Rolax',
            ],
            [
                'user_id' => $user1->id,
                'item_name' => 'HDD',
                'price' => '5000',
                'detail' => '高速で信頼性の高いハードディスク',
                'item_img' => 'items/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
                'brand' => '西芝',
            ],
            [
                'user_id' => $user1->id,
                'item_name' => '玉ねぎ3束',
                'price' => '300',
                'detail' => '新鮮な玉ねぎ3束のセット',
                'item_img' => 'items/onion.jpg',
                'condition' => 'やや傷や汚れあり',
                'brand' => '',
            ],
            [
                'user_id' => $user1->id,
                'item_name' => '革靴',
                'price' => '4000',
                'detail' => 'クラシックなデザインの革靴',
                'item_img' => 'items/shoes.jpg',
                'condition' => '状態が悪い',
                'brand' => '',
            ],
            [
                'user_id' => $user1->id,
                'item_name' => 'ノートPC',
                'price' => '45000',
                'detail' => '高性能なノートパソコン',
                'item_img' => 'items/notePc.jpg',
                'condition' => '良好',
                'brand' => 'Lenobo',
            ],
            [
                'user_id' => $user2->id,
                'item_name' => 'マイク',
                'price' => '8000',
                'detail' => '高音質のレコーディング用マイク',
                'item_img' => 'items/mic.jpg',
                'condition' => '目立った傷や汚れなし',
                'brand' => '',
            ],
            [
                'user_id' => $user2->id,
                'item_name' => 'ショルダーバッグ',
                'price' => '3500',
                'detail' => 'おしゃれなショルダーバッグ',
                'item_img' => 'items/bag.jpg',
                'condition' => 'やや傷や汚れあり',
                'brand' => '',
            ],
            [
                'user_id' => $user2->id,
                'item_name' => 'タンブラー',
                'price' => '500',
                'detail' => '使いやすいタンブラー',
                'item_img' => 'items/tumbler.jpg',
                'condition' => '状態が悪い',
                'brand' => '',
            ],
            [
                'user_id' => $user2->id,
                'item_name' => 'コーヒーミル',
                'price' => '4000',
                'detail' => '手動のコーヒーミル',
                'item_img' => 'items/coffeeMill.jpg',
                'condition' => '良好',
                'brand' => 'Starbucks',
            ],
            [
                'user_id' => $user2->id,
                'item_name' => 'メイクセット',
                'price' => '2500',
                'detail' => '便利なメイクアップセット',
                'item_img' => 'items/makeupSet.jpg',
                'condition' => '目立った傷や汚れなし',
                'brand' => '',
            ],
        ];
        DB::table('items')->insert($items);
    }
}
