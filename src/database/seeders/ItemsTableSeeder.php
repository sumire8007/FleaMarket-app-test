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
            'watch.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'hdd.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'onion.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'shoes.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'notePc.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'mic.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'bag.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'tumbler.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'coffeeMill.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'makeupSet.jpg' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
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
