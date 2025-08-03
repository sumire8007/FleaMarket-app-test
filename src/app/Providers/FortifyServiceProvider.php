<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        public function toResponse($request)
            {
                $loginUser = Auth::user();
                if($loginUser->email_verified_at == null){
                    return redirect('/email/verify');
                }else{
                    return redirect('/');
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        //ログイン処理
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if (!$user->hasVerifiedEmail()) {
                    throw ValidationException::withMessages([
                        'email' => ['メールアドレスが認証されていません。'],
                    ]);
                }
                return $user;
            }
        });
        //ビュー画面の表示
        Fortify::registerView(function (){
            return view('auth.register');
        });
        Fortify::loginView(function (){
            return view('auth.login');
        });
        //回数制限
        RateLimiter::for('login',function(Request $request){
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
