<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\CategoryItem;
use App\Models\Category;
class SellTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function setUp(): void{
        parent::setUp();
        $this->seed(CategoriesTableSeeder::class);
    }
    public function testSell()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
        $categories = Category::query()->inRandomOrder()->limit(2)->get();
        // dd($categories);
        $response = $this->actingAs($user)->get('/sell');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->post('/sell',[
            'user_id'=> $user->id,
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'item_img' => 'test.png',
            'condition' => '良好',
            'brand'=> 'test',
            'categories' => $categories->pluck('id')->toArray(),
        ]);

        $this->assertDatabaseHas('items', [
            'item_name' => '腕時計',
            'price' => '15000',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '良好',
            'brand' => 'test',
        ]);

        $item = Item::where('item_name', '腕時計')->first();
        $this->assertEquals(2, $item->categories()->count());
    }
}
