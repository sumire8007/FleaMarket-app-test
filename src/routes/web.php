<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;

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
Route::get('/',[ItemController::class,'index']);
Route::get('/item',[ItemController::class,'detail']);
Route::middleware('auth')->get('/sell',[ItemController::class,'sell']);
Route::middleware('auth')->get('/purchase',[ItemController::class,'purchase']);
Route::get('/mypage/profile',[AuthController::class,'edit']);
Route::middleware('auth')->get('/mypage',[AuthController::class,'mypage']);
Route::post('/sell',[ItemController::class,'store']);
Route::post('/',[AuthController::class,'store']);
Route::patch('/mypage/profile',[AuthController::class,'update']);
Route::get('/purchase/address',[AuthController::class,'addressView']);
Route::patch('/purchase/address',[AuthController::class,'addressEdit']);
Route::post('/item',[ItemController::class,'commentStore']);

Route::post('/item/like', [LikeController::class, 'likeItem']);
Route::get('/search',[ItemController::class,'search']);
Route::post('/purchase',[ItemController::class,'buy']);