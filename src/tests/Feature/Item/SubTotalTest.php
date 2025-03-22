<?php

namespace Tests\Feature\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\PaymentMethod;
use Database\Seeders\PaymentsTableSeeder;
use App\Models\Address;
use App\Models\Payment;
use App\Models\User;
use App\Models\Item;

class SubTotalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // public $payments;
    public function setUp(): void
    {
        parent::setUp();
        $this->payment = $this->seed(PaymentsTableSeeder::class);
    }

    public function testSubTotal()
    {
        $user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
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
        $item = Item::factory()->create();
        $payment = Payment::factory()->create([
            'content' => 'コンビニ払い']);
        $response = $this->post('login', ['email' => 'test123@example.com', 'password' => 'password123']);
        $response->assertRedirect('/');
        $response = $this->actingAs($user)->get(('/purchase?id=' . $item->id));
        $response->assertStatus(200);

        Livewire::test(PaymentMethod::class, ['id' => $item->id])
            ->set('selectedValue',$payment->id)
            ->assertSet('selectedPayment',$payment->content);
    }
}
