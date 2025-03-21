<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\PaymentsTableSeeder;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;
use App\Models\Purchase;
use App\Models\Payment;

class ShippingAddressTest extends TestCase
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
        $this->seed(PaymentsTableSeeder::class);
        dump(Payment::all()->toArray());
    }
    // 送付先住所変更画面にて登録した住所が商品購入画面に反映されている
    public function testAddressShow()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $profile = Address::factory()->create([
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
        $item = Item::factory()->create();
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($user)->get(('purchase/address'));
        $response->assertSee($profile->post_code);
        $response->assertSee($profile->address);
        $response->assertSee($profile->building);
        $profile->update([
            'post_code' => '765-1234',
            'address' => '東京都渋谷区千駄ヶ谷1-1',
            'building' => '千駄ヶ谷マンション101',
        ]);
        $response = $this->actingAs($user)->get(('/purchase?id='. $item->id));
        $response->assertSee($profile->post_code);
        $response->assertSee($profile->address);
        $response->assertSee($profile->building);
    }
    // 購入した商品に送付先住所が紐づいて登録される
    public function testItemShippingAddress()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $profile = Address::factory()->create([
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
        $item = Item::factory()->create();
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($user)->get(('purchase/address'));
        $response->assertSee($profile->post_code);
        $response->assertSee($profile->address);
        $response->assertSee($profile->building);
        $profile->update([
            'post_code' => '765-1234',
            'address' => '東京都渋谷区千駄ヶ谷1-1',
            'building' => '千駄ヶ谷マンション101',
        ]);
        $response = $this->actingAs($user)->get(('/purchase?id=' . $item->id));
        $purchase = Purchase::create( [
            'payment_id' => '1',
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
        $this->assertDatabaseHas('purchases', [
            'payment_id' => '1',
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $profile->id,
        ]);
    }
}
