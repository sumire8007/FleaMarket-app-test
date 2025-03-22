<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Address;
use App\Models\Payment;

class ItemListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }
    // 商品一覧で全商品を取得できる
    public function testItemAll()
    {
        $items = Item::factory()->count(10)->create();
        $response = $this->get(route('item.index'));
        $response->assertStatus(200);
        foreach ($items as $item) {
            $response->assertSee($item->item_name);
        }
    }
    // 商品一覧で購入済み商品は「Sold」と表示される
    public function testItemSold()
    {
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
            'condition' => '良好',
            'brand' => 'test_brand',
        ]);
        $user = User::factory()->create();
        $profile = Address::create([
            'user_id' => $user->id,
            'user_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png'
            ),
            'post_code' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷',
            'building' => '千駄ヶ谷マンション',
        ]);
        $payment = Payment::factory()->create();
        Purchase::create([
            'payment_id' => $payment->id,
            'user_id'=> $user->id,
            'item_id'=> $item->id,
            'address_id'=> $profile->id,
        ]);
        $response = $this->get(route('item.index'));
        $response->assertStatus(200);
        $response->assertSee('sold');
    }
    // 商品一覧で自分が出品した商品は表示されない
    public function testItemUserSell()
    {
        $user = User::factory()->create();
        Item::create([
            'user_id'=> $user->id,
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
            'condition' => '良好',
            'brand' => 'test_brand',
        ]);
        Item::create([
            'item_name' => 'HDD',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
            'condition' => '良好',
            'brand' => 'test_brand',
        ]);

        $response = $this->actingAs($user)->get(route('item.index'));
        $response->assertStatus(200);
        $response->assertDontSee('腕時計');
        $response->assertSee('HDD');
    }

}
