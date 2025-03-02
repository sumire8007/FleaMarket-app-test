<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Comment;
use App\Models\ItemLike;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // 商品一覧画面の表示　※ユーザが出品したものを表示しない
    public function index(Request $request){
        $user = Auth::user();
        $param = $request->query('id');

        if(isset($param)){
            $likes = ItemLike::where('user_id',$user->id)->pluck('item_id');
            $items = Item::whereIn('id',$likes)->get();
            return view('item',compact('user','items','param'));
        } else {
            if(Auth::check()){
                $user = Auth::user();
                $userItemIds = Item::where('user_id',$user->id)->pluck('id')->toArray();
                $items = Item::whereNotIn('id',$userItemIds)->get();
            } else {
                $items = Item::all();
            }
                return view('item',compact('items','user','param'));
        }
    }

    //検索機能
    public function search(Request $request){
        $items = Item::KeywordSearch($request->keyword)->get();
        $keyword = $request->keyword;
        // $request->session()->put('keyword',$keyword);
        return view('item',compact('items'));
    }
    // 商品詳細の表示 クエリパラメータを使用
    public function detail(Request $request){
        $id = $request->query('id');
        $item = Item::with(['categories'])->find($id);
        $user = Auth::user();
        $comments = Comment::where('item_id',$id)->with('user')->get();
        return view('item_detail',compact('item','user','comments'));
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
        $item = Item::with(['categories'])->find($id);
        $user = Auth::user();
        $comments = Comment::where('item_id',$id)->with('user')->get();
        return view('item_detail',compact('item','user','comments'));
    }
    // 商品購入画面の表示
    public function purchase(Request $request){
        $id = $request->query('id');
        $item = Item::where('id',$id)->first();
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        $payments = Payment::all();
        return view('purchase',compact('item','profiles','payments','user'));
    }
    //　商品の購入(決済)
    public function buy(Request $request){
        $purchase = $request->only(['payment_id','user_id','item_id','address_id']);
        Purchase::create($purchase);
        return redirect('/');
    }
    // 出品画面の表示
    public function sell(){
        $user = Auth::user();
        $categories = Category::all();
        return view('sell',compact('user','categories'));
    }
    // 出品されるアイテムの保存
    public function store(Request $request){
        $items = $request->only([
                            'user_id',
                            'condition',
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
