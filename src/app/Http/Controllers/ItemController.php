<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
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
            $user = Auth::user();
            $categories = Category::all();
            $conditions = Condition::all();
            return view('sell',compact('user','categories','conditions'));
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

    // 出品されるアイテムの保存
    public function store(Request $request){
        $items = $request->only([
                            'user_id',
                            'condition_id',
                            'item_name',
                            'price',
                            'detail',
                            'brand'
                            ]);
        //画像が送信されてきていたら保存処理
        if($request->hasFile('item_img')){
            $image = $request->file('item_img');
            $image_url = Storage::disk('public')->put('items', $image); //保存処理
            $items['item_img'] = $image_url;
        }
        $item = Item::create($items);

        // 選択されたカテゴリを紐づける
        if ($request->has('categories')) {
            $item->categories()->attach($request->categories);
        }
        return redirect('/');
    }
}
