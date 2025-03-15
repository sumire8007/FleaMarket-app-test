<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // 名前を入力せずに他の必要項目を入力する
    public function testNameNone(){
        $response = $this->post(route("register"));
        $response = $this->post('register',[
            'name' => '',
            'email' => 'test123@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['name']);
        $errors = session('errors')->get('name');
        $this->assertContains('お名前を入力してください', $errors);
    }

    // メールアドレスを入力せずに他の必要項目を入力する
    public function testEmailNone()
    {
        $response = $this->post(route("register"));
        $response = $this->post('register', [
            'name' => 'test123',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);
        $errors = session('errors')->get('email');
        $this->assertContains('メールアドレスを入力してください', $errors);
    }
    // パスワードを入力せずに他の必要項目を入力する
    public function testPasswordNone()
    {
        $response = $this->post(route("register"));
        $response = $this->post('register', [
            'name' => 'test123',
            'email' => 'test123@example.com',
            'password' => '',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['password']);
        $errors = session('errors')->get('password');
        $this->assertContains('パスワードを入力してください', $errors);
    }

    // 7文字以下のパスワードと他の必要項目を入力する
    public function testPasswordMin()
    {
        $response = $this->post(route("register"));
        $response = $this->post('register', [
            'name' => 'test123',
            'email' => 'test123@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['password']);
        $errors = session('errors')->get('password');
        $this->assertContains('パスワードは8文字以上で入力してください', $errors);
    }

    // 確認用パスワードと異なるパスワードを入力し、他の必要項目も入力する
    public function testPasswordConfirmed()
    {
        $response = $this->post(route("register"));
        $response = $this->post('register', [
            'name' => 'test123',
            'email' => 'test123@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456',
        ]);
        $response->assertSessionHasErrors(['password']);
        $errors = session('errors')->get('password');
        $this->assertContains('パスワードと一致しません', $errors);
    }
    // 全ての必要項目を正しく入力する
    public function testRegister()
    {
        $response = $this->post(route("register"));
        $response = $this->post('register', [
            'name' => 'test123',
            'email' => 'test123@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        // プロフを登録する
        $response = $this->post('/', [
            'user_img' => 'test.png',
            'post_code' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷',
            'building' => '千駄ヶ谷マンション',
        ]);
        $response->assertRedirect('http://localhost');
    }
}
