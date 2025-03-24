<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth')->group(function () {
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

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);
Route::get('/item',[ItemController::class,'detail']);
Route::post('/sell',[ItemController::class,'store']);
Route::post('/purchase', [ItemController::class, 'buy']);
Route::patch('/mypage/profile', [AuthController::class, 'update']);
Route::post('/search',[ItemController::class,'search']);
Route::post('/item/like', [LikeController::class, 'likeItem']);





Route::get('/payment/success', function () {
    return "決済成功！";
})->name('payment.success');

Route::get('/payment/cancel', function () {
    return "決済キャンセルされました";
})->name('payment.cancel');
