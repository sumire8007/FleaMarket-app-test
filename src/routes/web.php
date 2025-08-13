<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatDraftController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);

Route::middleware(['auth','verified'])->group(function () {
    //ビューの表示
    Route::get('/purchase', [ItemController::class, 'purchase']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::get('/mypage', [AuthController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/buy', [AuthController::class, 'mypage'])->name('mypage.buy');
    Route::get('/mypage/deal', [AuthController::class, 'mypage'])->name('mypage.deal');
    Route::get('/mypage/profile', [AuthController::class, 'edit']);
    Route::get('/purchase/address', [AuthController::class, 'addressView']);

    //各機能
    Route::get('/search', [ItemController::class, 'search']);
    Route::post('/', [AuthController::class, 'store']);
    Route::post('/item', [ItemController::class, 'commentStore']);
    Route::post('/sell', [ItemController::class, 'store']);
    Route::post('/purchase', [ItemController::class, 'buy']);
    Route::post('/item/like', [LikeController::class, 'likeItem']);
    Route::patch('/mypage/profile', [AuthController::class, 'update']);
    Route::patch('/purchase/address', [AuthController::class, 'addressEdit']);

    //Chat機能
    Route::get('/chat', [ChatController::class, 'chatView']);
    Route::post('/send/message', [ChatController::class, 'sendMessage']);
    Route::post('/completed', [ChatController::class, 'completed']);
    Route::post('/rating', [ChatController::class, 'store'])->name('rating.store');
    Route::post('/message/edit', [ChatController::class, 'edit'])->name('message.edit');
    Route::post('/message/delete', [ChatController::class, 'delete'])->name('message.delete');
    //チャットメッセージの入力値保持
    Route::post('/chat-draft/save', [ChatDraftController::class, 'save']);
    Route::get('/chat-draft/{itemId}', [ChatDraftController::class, 'get']);
    Route::post('/chat-draft/delete', [ChatDraftController::class, 'delete']);
});
Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::get('/item', [ItemController::class, 'detail']);

//Stripe決済
Route::get('/payment/success', function () {
    return "決済成功！";
})->name('payment.success');
Route::get('/payment/cancel', function () {
    return "決済キャンセルされました";
})->name('payment.cancel');

