<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class ItemListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // 商品一覧で全商品を取得できる
    public function testItemAll()
    {
        $response = $this->get(route("/"));
        $response->assertStatus(200);
        $this->assertDatabaseHas("items", [$response->items->toArray()]);
    }
    // 商品一覧で購入済み商品は「Sold」と表示される
    public function testItemSold()
    {
        
    }
    // 商品一覧で自分が出品した商品は表示されない
    public function testItemUserSell()
    {

    }
    // マイリスト一覧でいいねした商品だけが表示される
    public function testItemMyListLike()
    {

    }
    // マイリスト一覧で購入済み商品は「Sold」と表示される
    public function testItemMyListSold()
    {

    }
    // マイリスト一覧で自分が出品した商品は表示されない
    public function testItemMyListSell()
    {

    }
    // マイリスト一覧で未認証の場合は何も表示されない
    public function testItemMyListNone()
    {

    }
}
