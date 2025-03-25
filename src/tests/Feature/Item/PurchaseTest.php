<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;
use App\Models\Payment;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    // public $item;
    public function setUp(): void
    {
        parent::setUp();
    }
    // 「購入する」ボタンを押下すると購入が完了する
    public function testPurchase()
    {
        $user = User::create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
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
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'brand' => 'test',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
        ]);
        $payment = Payment::factory()->create();
        $response = $this->actingAs($user)->get('/purchase?id=' . $item->id);
        $response->assertStatus(200);
        $response = $this->actingAs($user)->post('/purchase?id=' . $item->id, [
            'payment_id'=> $payment->id,
            'user_id'=> $user->id,
            'item_id' => $item->id,
            'address_id'=> $profile->id,
        ]);
        $this->assertDatabaseHas('purchases',[
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
    }
    // 購入した商品は商品一覧画面にて「sold」と表示される
    public function testSoldShow()
    {
        User::factory()->count(2)->create();
        $user = User::create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
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
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'brand' => 'test',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
        ]);
        $payment = Payment::factory()->create();
        $response = $this->actingAs($user)->get('/purchase?id=' . $item->id);
        $response->assertStatus(200);
        $response = $this->actingAs($user)->post('/purchase?id=' . $item->id, [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertSee('sold');
    }
    // 「プロフィール/購入した商品一覧」に追加されている
    public function testMypageSold()
    {
        $user = User::create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
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
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'brand' => 'test',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
        ]);
        $payment = Payment::factory()->create();
        $response = $this->actingAs($user)->get('/purchase?id=' . $item->id);
        $response->assertStatus(200);
        $response = $this->actingAs($user)->post('/purchase?id=' . $item->id, [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
        $response = $this->actingAs($user)->get('/mypage?id=' . $user->id);
        $response->assertStatus(200);
        $response->assertSee('腕時計');
        $response->assertSee('test.png');
    }
}