<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ItemController::class,'index']);
Route::get('/mypage/profile',[AuthController::class,'edit']);
Route::get('/mypage',[ItemController::class,'mypage']);
Route::get('/sell',[ItemController::class,'sell']);
Route::get('/item',[ItemController::class,'detail']);
Route::get('/purchase',[ItemController::class,'purchase']);
Route::get('/purchase/address',[ItemController::class,'addressEdit']);