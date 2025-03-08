<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        foreach ($images as $filename => $url) {
            $imageContents = file_get_contents($url);
            Storage::put("public/items/{$filename}", $imageContents);
        }

        $items = [
            [
                'item_name' => '腕時計',
                'price' => '¥15,000',
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'item_img' => 'items/watch.jpg',
                'condition' => '良好',
            ],
            [
                'item_name' => 'HDD',
                'price' => '¥5,000',
                'detail' => '高速で信頼性の高いハードディスク',
                'item_img' => 'items/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'item_name' => '玉ねぎ3束',
                'price' => '¥300',
                'detail' => '新鮮な玉ねぎ3束のセット',
                'item_img' => 'items/onion.jpg',
                'condition' => 'やや傷や汚れあり',
            ],
            [
                'item_name' => '革靴',
                'price' => '¥4,000',
                'detail' => 'クラシックなデザインの革靴',
                'item_img' => 'items/shoes.jpg',
                'condition' => '状態が悪い',
            ],
            [
                'item_name' => 'ノートPC',
                'price' => '¥45,000',
                'detail' => '高性能なノートパソコン',
                'item_img' => 'items/notePc.jpg',
                'condition' => '良好',
            ],
            [
                'item_name' => 'マイク',
                'price' => '¥8,000',
                'detail' => '高音質のレコーディング用マイク',
                'item_img' => 'items/mic.jpg',
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'item_name' => 'ショルダーバッグ',
                'price' => '¥3,500',
                'detail' => 'おしゃれなショルダーバッグ',
                'item_img' => 'items/bag.jpg',
                'condition' => 'やや傷や汚れあり',

            ],
            [
                'item_name' => 'タンブラー',
                'price' => '¥500',
                'detail' => '使いやすいタンブラー',
                'item_img' => 'items/tumbler.jpg',
                'condition' => '状態が悪い',
            ],
            [
                'item_name' => 'コーヒーミル',
                'price' => '¥4,000',
                'detail' => '手動のコーヒーミル',
                'item_img' => 'items/coffeeMill.jpg',
                'condition' => '良好',
            ],
            [
                'item_name' => 'メイクセット',
                'price' => '¥2,500',
                'detail' => '便利なメイクアップセット',
                'item_img' => 'items/makeupSet.jpg',
                'condition' => '目立った傷や汚れなし',
            ],
        ];
        DB::table('items')->insert($items);
    }
}
