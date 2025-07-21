<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryItem;

class CategoryItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $watch_categories = [1, 5, 9];
        foreach($watch_categories as $watch_category){
            CategoryItem::create([
                'item_id' => 1,
                'category_id' => $watch_category
            ]);
        }

        $hdd_categories = [1,4];
        foreach($hdd_categories as $hdd_category){
            CategoryItem::create([
                'item_id' => 2,
                'category_id' => $hdd_category
            ]);
        }

        $onion_categories = [1,10];
        foreach ($onion_categories as $onion_category) {
            CategoryItem::create([
                'item_id' => 3,
                'category_id' => $onion_category
            ]);
        }

        $shoes_categories = [2,3];
        foreach ($shoes_categories as $shoes_category) {
            CategoryItem::create([
                'item_id' => 4,
                'category_id' => $shoes_category
            ]);
        }

        $pc_categories = [2,8];
        foreach ($pc_categories as $pc_category) {
            CategoryItem::create([
                'item_id' => 5,
                'category_id' => $pc_category
            ]);
        }

        $mic_categories = [2, 3,13];
        foreach ($mic_categories as $mic_category) {
            CategoryItem::create([
                'item_id' => 6,
                'category_id' => $mic_category
            ]);
        }

        $bag_categories = [4, 11];
        foreach ($bag_categories as $bag_category) {
            CategoryItem::create([
                'item_id' => 7,
                'category_id' => $bag_category
            ]);
        }
        $tumbler_categories = [9, 10];
        foreach ($tumbler_categories as $tumbler_category) {
            CategoryItem::create([
                'item_id' => 8,
                'category_id' => $tumbler_category
            ]);
        }
    }
}
