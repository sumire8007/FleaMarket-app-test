<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_name' => '腕時計',
            'price' => '15,000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'condition_id' => '1',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'HDD',
            'price' => '5,000',
            'detail' => '高速で信頼性の高いハードディスク',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'condition_id' => '2',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => '玉ねぎ3束',
            'price' => '300',
            'detail' => '新鮮な玉ねぎ3束のセット',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'condition_id' => '3',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => '革靴',
            'price' => '4,000',
            'detail' => 'クラシックなデザインの革靴',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'condition_id' => '4',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'ノートPC',
            'price' => '45,000',
            'detail' => '高性能なノートパソコン',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'condition_id' => '1',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'マイク',
            'price' => '8,000',
            'detail' => '高音質のレコーディング用マイク',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'condition_id' => '2',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'ショルダーバッグ',
            'price' => '3,500',
            'detail' => 'おしゃれなショルダーバッグ',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'condition_id' => '3',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'タンブラー',
            'price' => '500',
            'detail' => '使いやすいタンブラー',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'condition_id' => '4',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'コーヒーミル',
            'price' => '4,000',
            'detail' => '手動のコーヒーミル',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'condition_id' => '1',
        ];
        DB::table('items')->insert($param);
        $param = [
            'item_name' => 'メイクセット',
            'price' => '2,500',
            'detail' => '便利なメイクアップセット',
            'item_img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'condition_id' => '2',
        ];
        DB::table('items')->insert($param);
    }
}
