<?php

namespace Tests\Feature\Item;

use App\Models\CategoryItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemLike;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Address;

class ItemDetailTest extends TestCase
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
        $this->seed(CategoriesTableSeeder::class);
    }
    //すべての情報が商品詳細ページに表示されている
    // 複数選択されたカテゴリが表示されているか
    public function testDetailAll()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $categories = Category::query()->inRandomOrder()->limit(2)->get();
        $item = Item::create([
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => new UploadedFile(
                public_path('img/test.png'),
                'test.png',
                'image/png',
            ),
            'condition' => '良好',
            'brand' => 'test_brand',
            'categories' => $categories->pluck('id')->toArray(),
        ]);
        foreach ($categories as $category) {
            CategoryItem::create([
                'item_id' => $item->id,
                'category_id' => $category->id,
            ]);
        }
        ItemLike::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
        $comment = Comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment'=> 'コメントのテストです。',
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
        $likeCount = ItemLike::where('item_id', $item->id)->count();
        $commentCount = Comment::where('item_id', $item->id)->count();
        $response = $this->get('/item?id=' . $item->id);
        $response->assertStatus(200);
        $response->assertSee('test.png');
        $response->assertSee('腕時計');
        $response->assertSee('test_brand');
        $response->assertSee('15000');
        $response->assertSee($likeCount);
        $response->assertSee($commentCount);
        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');
        foreach ($categories as $category){
            $response->assertSee($category->content);
        }
        $response->assertSee('良好');
        $response->assertSee($profile->user_img);
        $response->assertSee($comment->user->name);
        $response->assertSee('('.$commentCount.')');
        $response->assertSee($comment->comment);
    }
}
