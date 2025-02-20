<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // 出品
    public function store(Request $request){
        $items = $request->only(['user_id','category_id','condition_id','item_name','price','detail','brand']);
        $image = $request->file('item_img');
        $item['item_img'] = $image_url;
        $categoryIds = $request->input('categories',[]);
        Item::create($items);
        //画像が送信されてきていたら保存処理
        if($image){
            //保存されたパス
            $image_url = Storage::disk('public')->put('items', $image); //画像の保存処理
            $item->item_img = $image_url;
            $item->save();
        }
        if (!empty($categoryIds)) {
            $item->categories()->attach($categoryIds);  // 多対多の関連付け
        }

        return redirect('/');

    }
}
