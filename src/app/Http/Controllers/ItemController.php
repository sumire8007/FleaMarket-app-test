<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // 商品一覧画面の表示
    public function index(){
        return view('item');
    }
    // マイページの表示
    public function mypage(){
        return view('profile');
    }
    // 出品画面の表示
    public function sell(){
            return view('sell');
        }


    // 商品詳細の表示 クエリパラメータを使用
    // public function detail(Request $request){
    //     $detail = item::find($request->id);
    //     return view('item_detail',$detail);
    // }
    public function detail(){
        return view('item_detail');
    }
    // 商品購入画面の表示
    public function purchase(){
        return view('purchase');
    }
    // 商品配送先の住所変更
    public function addressEdit(){
        return view('address_edit');
    }

}
