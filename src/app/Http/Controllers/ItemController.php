<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Address;
use App\Models\Item;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Comment;
use App\Models\ItemLike;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ExhibitionRequest;
use phpDocumentor\Reflection\Types\Null_;
class ItemController extends Controller
{
    // 商品一覧画面の表示
    public function index(Request $request)
    {
        $keyword = $request->session()->get('keyword');
        $user = Auth::user();
        $param = $request->query('id');
        $paramUrl = $request->has('id');
        $itemIds = Item::pluck('id')->toArray();
        $sold = Purchase::whereIn('item_id', $itemIds)->pluck('item_id');

        // もし、クエリパラメータが存在し、かつ空文字なら、$items を空にする
        if ($request->has('id') && empty($param)) {
            $items = [];
        }
        // もし、クエリパラメータが存在し、値があったら$itemsにユーザーがいいねしたものを入れる
        elseif (isset($param)) {
            $likes = ItemLike::where('user_id', $param)->pluck('item_id');
            $items = Item::whereIn('id', $likes)->get();
        }
        // もし、クエリパラメータが無かったら（NULLなら）、おすすめを表示（ログインしてたら、ユーザーが出品したものを表示しない）
        else {
            if (Auth::check()) {
                $userItemIds = Item::where('user_id', $user->id)->pluck('id')->toArray();
                $items = Item::whereNotIn('id', $userItemIds)->get();
            } else {
                $items = Item::all();
            }
        }
        return view('item', compact('items', 'user', 'param', 'sold', 'paramUrl','keyword'));
    }
    //検索機能
    public function search(Request $request)
    {
        $user = Auth::user();
        $param = $request->query('id');
        $paramUrl = $request->has('id');
        $itemIds = Item::pluck('id')->toArray();
        $sold = Purchase::whereIn('item_id', $itemIds)->pluck('item_id');
        $keyword = $request->keyword;
        $request->session()->put('keyword', $keyword);
        if($paramUrl){
            $searchItemId = Item::KeywordSearch($keyword)->pluck('id')->toArray();
            $userLikeItemIds = ItemLike::where('user_id', $user->id)->pluck('item_id')->toArray();
            $matchIds = array_intersect( $searchItemId, $userLikeItemIds);
            $items = Item::whereIn('id', $matchIds)->get();
        }else{
            $items = Item::KeywordSearch($keyword)->get();
        }
        return view('item', compact('items', 'user','param','sold','paramUrl','keyword'));
    }
    // 商品詳細の表示
    public function detail(Request $request){
        $id = $request->query('id');
        $item = Item::with(['categories'])->find($id);
        $user = Auth::user();
        $comments = Comment::where('item_id',$id)->with('user')->get();
        $userIds = $comments->pluck('user_id');
        $profiles = Address::whereIn('user_id',$userIds)->get()->keyBy('user_id');
        return view('item_detail',compact('item','user','comments','profiles'));
    }
    //コメントの作成
    public function commentStore(CommentRequest $request){
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
        $userIds = $comments->pluck('user_id');
        $profiles = Address::whereIn('user_id',$userIds)->get()->keyBy('user_id');
        return redirect('/item?id='.$item->id);
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
    public function buy(PurchaseRequest $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $item = Item::find($request->item_id);
        $purchase = $request->only([
                            'payment_id',
                            'user_id',
                            'item_id',
                            'address_id',
                        ]);
        Purchase::create($purchase);
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card','konbini'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $item->item_name,
                            'images' => [asset('storage/' . $item->item_img)],
                        ],
                        'unit_amount' => $item->price,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('payment.cancel'),
        ]);
        return redirect($session->url);
    }

    // 出品画面の表示
    public function sell(){
        $user = Auth::user();
        $categories = Category::all();
        return view('sell',compact('user','categories'));
    }
    // 出品されるアイテムの保存
    public function store(ExhibitionRequest $request){
        $items = $request->only([
                            'user_id',
                            'condition',
                            'item_name',
                            'price',
                            'detail',
                            'brand',
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
