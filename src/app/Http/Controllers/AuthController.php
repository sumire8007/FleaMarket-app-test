<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Address;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Chat;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;


class AuthController extends Controller
{
    // マイページの表示
    public function mypage(){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        //自分が購入したアイテムの出品者情報

        //自分が出品したもので、取引メッセージが来ているもの
        $sellItems = Item::where('user_id',$user->id)->pluck('id');
        $sellChats = Chat::whereIn('item_id', $sellItems)
            ->where('completed_at', NULL)
            ->get();
        //自分がメッセージを送ってまだ完了していないもの
        $dealChats = Chat::where('user_id', $user->id)
            ->where('completed_at', NULL)
            ->get();
        //「取引中の商品」に表示させるもの（自分が出品したアイテムのチャットと自分がメッセージを送ったもの）
        $allChats = $sellChats->merge($dealChats)->sortByDesc('created_at')->unique('chat_flag')->values();

        if (request()->routeIs('mypage.buy')) {
            $purchases = Purchase::where('user_id', $user->id)->pluck('item_id');//購入した商品&商品の出品者情報
            $items = Item::whereIn('id', $purchases)->get();
        } elseif (request()->routeIs('mypage')) {
            $items = Item::where('user_id', $user->id)->get(); //出品した商品
        } elseif (request()->routeIs('mypage.deal')) {
            $items = $allChats;//取引中の商品
        }
        return view('mypage',compact('user','profiles','items'));
    }
    // プロフィール設定の表示（初回含む）
    public function edit(){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        return view('profile_edit', compact('user','profiles'));
    }
    // プロフィール設定の新規登録
    public function store(ProfileRequest $request){
        $profiles = $request->only([
                                'user_id',
                                'post_code',
                                'address',
                                'building'
                                ]);
        if($request->hasFile('user_img')){
            $image = $request->file('user_img');
            $image_url = Storage::disk('public')->put('users', $image);
            $profiles['user_img'] = $image_url;
        }
        Address::create($profiles);
        return redirect('/');
    }
    // プロフィール設定の更新
    public function update(ProfileRequest $request){
        $profiles = $request->only([
                                'user_id',
                                'post_code',
                                'address',
                                'building'
                            ]);
        $userName = $request->only(['name']);
        User::find($request->user_id)->update($userName);
        if($request->hasFile('user_img')){
            $image = $request->file('user_img');
            $image_url = Storage::disk('public')->put('users', $image);
            $profiles['user_img'] = $image_url;
        }
        Address::find($request->id)->update($profiles);
        return redirect('/mypage/profile');
    }

    //配送先住所の変更画面表示
    public function addressView(){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        return view('address_edit',compact('profiles','user'));
    }
    //配送先住所の変更
    public function addressEdit(AddressRequest $request){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        if(empty($profiles)) {
            Address::create([
                'user_img' => "",
                'user_id'=> $user->id,
                'post_code' => $request->post_code,
                'address'=> $request->address,
                'building' => $request->building,
            ]);
        } else {
            $profiles->update([
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        }
        return redirect('/purchase/address');
    }
}