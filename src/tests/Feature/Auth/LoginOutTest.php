<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Models\User;

class LoginOutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'テスト',
            'email' => 'test123@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
    // メールアドレスが入力されていない場合、「メールアドレスを入力してください」というバリデーションメッセージが表示される
    public function testEmailNone()
    {
        $response = $this->post('login', [
            'email' => '',
            'password' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        $this->assertContains('メールアドレスを入力してください', $errors);
    }
    // パスワードが入力されていない場合、「パスワードを入力してください」というバリデーションメッセージが表示される
    public function testPasswordNone()
    {
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['password']);
        $errors = session('errors')->get('password');
        $this->assertContains('パスワードを入力してください', $errors);
    }
    // 入力情報が間違っている場合、「ログイン情報が登録されていません」というバリデーションメッセージが表示される
    public function testLoginCheck()
    {
        // もしパスワードが間違っていた場合
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password456'
        ]);
        $errors = session('errors')->getBag('default')->get('email');
        $this->assertContains('ログイン情報が登録されていません', $errors);

        // もしメールアドレスが間違っていた場合
        $response = $this->post('login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);
        $errors = session('errors')->getBag('default')->get('email');
        $this->assertContains('ログイン情報が登録されていません', $errors);
    }
    // 正しい情報が入力された場合、ログイン処理が実行される
    public function testLogin()
    {
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password123',
        ]);
        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect('/');
    }
    // ログアウトができる
    public function testLogout()
    {
        $response = $this->post('login', [
            'email' => 'test123@example.com',
            'password' => 'password123',
        ]);
        $response = $this->post('/logout');
        $this->assertGuest();
    }

}
