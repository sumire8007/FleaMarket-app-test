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

    public function setUp(): void
    {
        parent::setUp();
    }
    // 商品一覧で全商品を取得できる
    public function testItemAll()
    {

    }
    // 商品一覧で購入済み商品は「Sold」と表示される
    public function testItemSold()
    {

    }
    // 商品一覧で自分が出品した商品は表示されない
    public function testItemUserSell()
    {

    }

}
