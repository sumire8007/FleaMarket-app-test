<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testSearch()
    {
        $response = $this->get(route("item.index"));
        $response->assertStatus(200);
        $items = Item::factory()->createMany([
            [
                'item_name' => '腕時計',
                'price' => '15000',
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'item_img' => 'test.png',
                'condition' => '良好',
            ],
            [
                'item_name' => 'HDD',
                'price' => '5000',
                'detail' => '高速で信頼性の高いハードディスク',
                'item_img' => 'items/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
            ]
        ]);
        $response = $this->post('/search', [
            'keyword' => '時計',
        ]);
        foreach ($items as $item) {
            if (str_contains($item->item_name, '時計')) {
                $response->assertSee($item->item_name);
            }
        }
    }
}
