<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\PaymentsTableSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // public $item;
    public $user;
    public $profile;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $this->profile = Address::factory()->create([
            'user_id' => $this->user->id,
            'user_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png'
            ),
            'post_code' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷',
            'building' => '千駄ヶ谷マンション',
        ]);
        // $this->item = Item::factory()->create();
        $this->seed(PaymentsTableSeeder::class);
    }
    // 「購入する」ボタンを押下すると購入が完了する
    public function testPurchase()
    {
        $item = Item::factory()->create();
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($this->user)->get('/purchase?id='.$item->id);
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->post('/purchase?id=' . $item->id,[
            'payment_id' => '1',
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'address_id' => $this->profile->id,
        ]);
        $this->assertDatabaseHas('purchases', [
            'payment_id' => '1',
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'address_id' => $this->profile->id,
        ]);
    }
    // 購入した商品は商品一覧画面にて「sold」と表示される
    public function testSoldShow()
    {
        $item = Item::factory()->create();
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($this->user)->get('/purchase?id=' . $item->id);
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->post('/purchase?id=' . $item->id, [
            'payment_id' => '1',
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'address_id' => $this->profile->id,
        ]);
        $this->assertDatabaseHas('purchases', [
            'payment_id' => '1',
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'address_id' => $this->profile->id,
        ]);
        // $response->assertSee('sold');
    }
    // 「プロフィール/購入した商品一覧」に追加されている
    // public function testSoldShow2()
    // {

    // }
    // 小計画面で変更が即時反映される
    // public function testSubtotal()
    // {

    // }
    // 送付先住所変更画面にて登録した住所が商品購入画面に反映されている
    // public function testSippingAddress()
    // {

    // }
    // 購入した商品に送付先住所が紐づいて登録される
    // public function testPurchaseTable()
    // {

    // }
}