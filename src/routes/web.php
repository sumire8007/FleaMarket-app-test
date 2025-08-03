<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// メール認証
Route::get('/email/verify', function () {
    return view('auth.email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    Auth::user()->sendEmailVerificationNotification();
    return back()->with('message', '認証メールを再送しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//ユーザー機能
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/purchase', [ItemController::class, 'purchase']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/item', [ItemController::class, 'commentStore']);
    Route::get('/mypage', [AuthController::class, 'mypage']);
    Route::get('/mypage/profile', [AuthController::class, 'edit']);
    Route::get('/purchase/address', [AuthController::class, 'addressView']);
});

Route::prefix('/')->group(function () {
    Route::get('', [ItemController::class, 'index'])->name('item.index');
    Route::post('', [AuthController::class, 'store']);
});

Route::patch('/purchase/address', [AuthController::class, 'addressEdit']);
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);
Route::get('/item',[ItemController::class,'detail']);
Route::post('/sell',[ItemController::class,'store']);
Route::post('/purchase', [ItemController::class, 'buy']);
Route::patch('/mypage/profile', [AuthController::class, 'update']);
Route::get('/search',[ItemController::class,'search']);
Route::post('/item/like', [LikeController::class, 'likeItem']);

//Stripe決済
Route::get('/payment/success', function () {
    return "決済成功！";
})->name('payment.success');

Route::get('/payment/cancel', function () {
    return "決済キャンセルされました";
})->name('payment.cancel');
