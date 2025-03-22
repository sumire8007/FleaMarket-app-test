<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ItemLike;
use App\Models\User;
use App\Models\Item;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    // いいねアイコンを押下することによって、いいねした商品として登録することができる。
    public function testLikeRegister()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $item = Item::factory()->create();
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/item?id=' . $item->id);
        $response = $this->postJson('/item/like',['item_id' => $item->id]);
        $this->assertDatabaseHas('item_likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $itemLikes = ItemLike::where('item_id',$item->id)->count();
        $response->assertSee($itemLikes);
    }

    // 追加済みのアイコンは色が変化する
    public function testLikeColor()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $item = Item::factory()->create();
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/item?id=' . $item->id);
        $response = $this->postJson('/item/like', ['item_id' => $item->id]);
        dump($response->json());
        $response->assertRedirect('/item?id=' . $item->id);
        $response->assertJson('color: #ff5555;');
    }
    // 再度いいねアイコンを押下することによって、いいねを解除することができる。
    public function testLikeCancel()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $item = Item::factory()->create();
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id
        ]);
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/item?id=' . $item->id);
        $LikesCount = $item->likes->count();
        $response = $this->postJson('/item/like', ['item_id' => $item->id]);
        $this->assertDatabaseMissing('item_likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $itemLikes = ItemLike::where('item_id', $item->id)->count();
        $response->assertSee($itemLikes);
    }
}
