<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Address;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // ログイン済みのユーザーはコメントを送信できる
    public function testCommentSend()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $profiles = Address::factory()->create([
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
        $item = Item::factory()->create([
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
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($user)->post('/item',[
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'コメントのテストです。',
        ]);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'コメントのテストです。',
        ]);
        $response = $this->get('/item?id='. $item->id);
        $response->assertStatus(200);
        $comments = Comment::where('item_id',$item->id)->count();
        $this->assertEquals(1, $comments);
        $response->assertSee($comments);
    }
    // ログイン前のユーザーはコメントを送信できない
    public function testNotLoginComment()
    {
        $response = $this->post('/item', [
            'user_id' => 1,
            'item_id' => 1,
            'comment' => 'コメントのテストです。',
        ]);
        $response->assertRedirect('login');
    }
    // コメントが入力されていない場合、バリデーションメッセージが表示される
    public function testNotComment()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $response = $this->actingAs($user)->post('/item', [
            'user_id' => $user->id,
            'item_id' => 1,
            'comment' => '',
        ]);
        $response->assertSessionHasErrors(['comment']);
        $errors = session('errors')->get('comment');
        $this->assertContains('コメントを入力してください', $errors);
    }
    public function testComment256()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $response = $this->actingAs($user)->post('/item', [
            'user_id' => $user->id,
            'item_id' => 1,
            'comment' => 'この商品を購入してから数週間が経ちましたが、非常に満足しています。デザインが洗練されており、どんなインテリアにも馴染みます。特に使い心地が素晴らしく、長時間使用しても疲れにくい点が気に入りました。素材もしっかりしており、耐久性が高いと感じます。また、機能性も優れており、操作が簡単で直感的に使えます。コストパフォーマンスも高く、この価格でこれほどの品質を得られるのは驚きです。配送も迅速で、梱包も丁寧だったため、安心して受け取ることができました。総合的に見て非常に満足度の高い商品、自信を持っておすすめできます。',
        ]);
        $response->assertSessionHasErrors(['comment']);
        $errors = session('errors')->get('comment');
        $this->assertContains('コメントは255文字以内で入力してください', $errors);
    }
}
