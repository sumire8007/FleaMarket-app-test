<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
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

    protected $items;
    protected $user;
    protected $sold;
    protected $address;
    protected $payment;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->payment = Payment::factory()->create();
        $this->items = Item::factory()->count(5)->create(['user_id' => $this->user->id]);
        $this->address = Address::factory()->count(5)->create(['user_id' => $this->user->id]);

        // dd([
        //     'items' => $this->items->toArray(),
        //     'addresses' => $this->address->toArray(),
        //     'first_address' => Address::where('user_id', $this->user->id)->first(),
        // ]);

        $this->sold = Purchase::factory()->count(2)->create([
            'payment_id' => $this->payment->id,
            'user_id'=> $this->user->id,
            'item_id' => $this->items->random()->id,
            'address_id'=> Address::where('user_id',$this->user->id)->first()->id,
        ]);
    }
    // 商品一覧で全商品を取得できる
    public function testItemAll()
    {
        $response = $this->get(route("item.index"));
        $response->assertStatus(200);
        // dd($response->content());
        foreach($this->items as $item){
            $response->assertSee($item->id);
        }
    }
    // 商品一覧で購入済み商品は「Sold」と表示される
    public function testItemSold()
    {
        $response = $this->get(route("item.index"));
        $response->assertStatus(200);
        foreach ($this->sold as $sold) {
            $response->assertSee($sold->item_id);
        }
    }
    // 商品一覧で自分が出品した商品は表示されない
    // public function testItemUserSell()
    // {

    // }
    // マイリスト一覧でいいねした商品だけが表示される
    // public function testItemMyListLike()
    // {

    // }
    // マイリスト一覧で購入済み商品は「Sold」と表示される
    // public function testItemMyListSold()
    // {

    // }
    // マイリスト一覧で自分が出品した商品は表示されない
    // public function testItemMyListSell()
    // {

    // }
    // マイリスト一覧で未認証の場合は何も表示されない
    // public function testItemMyListNone()
    // {

    // }
}
