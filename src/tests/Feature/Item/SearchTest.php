<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemLike;


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
        Item::create([
                'item_name' => '腕時計',
                'price' => '15000',
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'item_img' => 'test.png',
                'condition' => '良好',
        ]);
        Item::create([
                'item_name' => 'HDD',
                'price' => '5000',
                'detail' => '高速で信頼性の高いハードディスク',
                'item_img' => 'items/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
            ]);
        $response = $this->get('/search?keyword=時計');
        $response->assertSee('腕時計');
    }

    // 検索状態がマイリストでも保持されている
    public function testSearchMyList()
    {
        $user = User::create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => 'test.png',
            'condition' => '良好',
        ]);
        Item::create([
            'item_name' => 'HDD',
            'price' => '5000',
            'detail' => '高速で信頼性の高いハードディスク',
            'item_img' => 'items/hdd.jpg',
            'condition' => '目立った傷や汚れなし',
        ]);
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
        $response = $this->get('/search?keyword=時計');
        $response->assertSee('腕時計');
        $response = $this->actingAs($user)->get('/search?id='.$user->id.'&keyword=時計');
        $response->assertSee('腕時計');
    }
}
