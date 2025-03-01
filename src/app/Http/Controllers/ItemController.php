<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Payment;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // 商品一覧画面の表示
    public function index(){
        $items = Item::all();
        return view('item',compact('items'));
    }
    // 商品詳細の表示 クエリパラメータを使用
    public function detail(Request $request){
        $id = $request->query('id');
        $item = Item::with(['categories','condition'])->find($id);
        $condition = Condition::where('id',$item->condition_id)->first();
        $user = Auth::user();
        return view('item_detail',compact('item','condition','user'));
    }
    // 商品購入画面の表示
    public function purchase(Request $request){
        $id = $request->query('id');
        $item = Item::where('id',$id)->first();
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        $payments = Payment::all();
        return view('purchase',compact('item','profiles','payments'));
    }
    //コメントの作成
    public function commentStore(Request $request){
        $comment = $request->only([
            'user_id',
            'item_id',
            'comment',
        ]);
        Comment::create($comment);
        $id = $request->item_id;
        return redirect('/item')->with('id',$id);
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
