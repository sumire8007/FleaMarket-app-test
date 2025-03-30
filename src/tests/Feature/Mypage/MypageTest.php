<?php

namespace Tests\Feature\Mypage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;
use App\Models\Purchase;
use App\Models\Payment;


class MypageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public $user;
    public $profile;
    public function setUp(): void{
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $this->profile = Address::factory()->create([
            'user_id' => $this->user->id,
            'user_img'=> new UploadedFile(
        public_path('img/test.png'),
'test.png',
    'image/png'
            ),
            'post_code' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷',
            'building' => '千駄ヶ谷マンション',
        ]);
    }
    // 必要な情報が取得できる（プロフィール画像、ユーザー名、出品した商品一覧、購入した商品一覧）
    public function testMypageShow(){
        $items = Item::factory()->count(5)->create();
        $payment = Payment::create([
            'content' => 'コンビニ払い'
        ]);

        $itemNoUser = Item::where('user_id', '!=', $this->user->id)->get();
        $sell = Item::factory()->create([
            'user_id'=> $this->user->id,
            'item_name' => 'テスト',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'brand' => 'test',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
                null,
                true
            ),
        ]);
        $sold = Purchase::factory()->create([
            'payment_id' => $payment->id,
            'user_id'=> $this->user->id,
            'item_id'=> $itemNoUser->random(1)->first()->id,
            'address_id'=> $this->profile->id,
        ]);
        $soldItemName = Item::where('id',$sold->item_id)->first();
        $response = $this->post('login', ['email'=> 'test123@example.com', 'password' => 'password123']);
        // ユーザーが出品した商品が表示されているか
        $response = $this->actingAs($this->user)->get('/mypage');
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee($this->profile->user_img);
        $response->assertSee($sell->item_name);
        $response->assertSee($sell->item_img);
        // ユーザーが購入した商品が表示されているか
        $response = $this->actingAs($this->user)->get('/mypage?id='.$this->user->id);
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee($this->profile->user_img);
        $response->assertSee($soldItemName->item_name);
        $response->assertSee($soldItemName->item_img);
    }

    //変更項目が初期値として過去設定されていること（プロフィール画像、ユーザー名、郵便番号、住所）
    public function testProfileShow()
    {
        $response = $this->post('login', [$this->user]);
        $response = $this->actingAs($this->user)->get('/mypage/profile?id='.$this->user->id);
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee('public/img/test.png');
        $response->assertSee($this->profile->post_code);
        $response->assertSee($this->profile->address);
        $response->assertSee($this->profile->building);
    }
}

