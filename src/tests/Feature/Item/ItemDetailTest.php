<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemLike;
use App\Models\Comment;
class ItemDetailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    protected $itemLikes;
    protected $comments;
    protected function setUp(): void{
        parent::setUp();

        $this->itemLikes = ItemLike::factory()->create();
        $this->comments = Comment::factory()->create();
    }

    //すべての情報が商品詳細ページに表示されている
    public function testDetailAll()
    {
        $item = Item::factory()->create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => 'test.png',
            'condition' => '良好',
            'brand'=> 'test',
        ]);
        $response = $this->get('/item?id=1');
        $response->assertSee('腕時計');
        $response->assertSee('15000');
        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');
        $response->assertSee('test.png');
        $response->assertSee('良好');
        $response->assertSee($this->itemLikes->count());
        $response->assertSee($this->comments->count());
        $response->assertSee($this->comments->user_name);
        $response->assertSee($this->comments->content);
    }
}
