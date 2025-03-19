<?php

namespace Tests\Feature\Item;

use App\Models\ItemLike;
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
    protected $users;
    protected $solds;
    protected $address;
    protected $payment;
    protected $likes;
    public function setUp(): void
    {
        parent::setUp();
        $this->users = User::factory()->count(20)->create();
        $this->payment = Payment::factory()->create();
        $this->items = Item::factory()->count(15)->make()->each(function ($item) {
            $item->user_id = $this->users->random()->id;
            $item->save();
        });
        $this->address = $this->users->map(function ($user) {
            return Address::factory()->create(['user_id' => $user->id]);
        });
        // dd([
        //     'user'=> $this->users->toArray(),
        //     'items' => $this->items->toArray(),
        //     'addresses' => $this->address->toArray(),
        //     // 'first_address' => Address::where('user_id', $this->user->id)->first(),
        // ]);
        // dd($this->items, $this->items->count());
        $user = $this->users->random(5);
        $item = $this->items->random(5);
        $address = $this->address->where('user_id', $user->id)->first();

        $this->solds = Purchase::factory()->count(6)->create([
            'payment_id' => $this->payment->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id' => $address->id]);
            dd($this-> solds);

        $this->likes = ItemLike::factory()->count(10)->create([
            'user_id' => $user = $this->users->random()->id,
            'item_id' => $this->items->random()->id
        ]);
    }
    // 商品一覧で全商品を取得できる
    public function testItemAll()
    {
        $response = $this->get(route("item.index"));
        $response->assertStatus(200);
        foreach($this->items as $item){
            $response->assertSee($item->id);
        }
    }
    // 商品一覧で購入済み商品は「Sold」と表示される
    public function testItemSold()
    {
        $response = $this->get(route("item.index"));
        $response->assertStatus(200);
        foreach ($this->solds as $sold) {
            $response->assertSee($sold->item_id);
        }
    }
    // 商品一覧で自分が出品した商品は表示されない
    public function testItemUserSell()
    {
        $user = $this->users->random();
        $userItemIds = Item::where("user_id","!=",$user->id)->get();
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertRedirect('/');
        $response = $this->get(route("item.index"));
        foreach ($userItemIds as $item) {
            $response->assertSee($item->id);
        }
    }
    // マイリスト一覧でいいねした商品だけが表示される
    public function testItemMyListLike()
    {
        $user = $this->users->random();
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertRedirect('/');
        $response = $this->get('/?id='.$user->id);
        foreach ($this->likes as $like) {
            $response->assertSee($like->item_id);
        }
    }
    // マイリスト一覧で購入済み商品は「Sold」と表示される
    public function testItemMyListSold()
    {
        $user = $this->users->random();
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertRedirect('/');
        $response = $this->get('/?id=' . $user->id);
        dd($response->getContent());
        // foreach ($this->likes as $like) {
        //     $response->assertSee($like->item_id);
        // }
        foreach ($this->solds as $sold) {
            $response->assertSee('sold');
        }
    }
    // マイリスト一覧で自分が出品した商品は表示されない
    // public function testItemMyListSell()
    // {

    // }
    // マイリスト一覧で未認証の場合は何も表示されない
    // public function testItemMyListNone()
    // {

    // }
}
