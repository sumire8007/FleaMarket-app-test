<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemLike;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Purchase;



class MyListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testMyList()
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
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $response = $this->get('/?id='.$user->id);
        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
    }
    // 購入済み商品は「Sold」と表示される
    public function testMyListSold()
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
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $response = $this->get('/?id=' . $user->id);
        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertSee('sold');
    }
    // 自分が出品した商品は表示されない
    public function testMyListItemUserSell()
    {
        $user = User::factory()->create();
        Item::create([
            'user_id' => $user->id,
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
        $item = Item::create([
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
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $response = $this->get('/?id=' . $user->id);
        $response->assertStatus(200);
        $response->assertDontSee('腕時計');
        $response->assertSee('HDD');
    }
    // 未認証の場合は何も表示されない
    public function testBuy()
    {
        
    }
}
