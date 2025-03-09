<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Address;
use App\Models\User;
use App\Models\Purchase;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;



class AuthController extends Controller
{
    // マイページの表示
    public function mypage(Request $request){
        $param = $request->query('id');
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        if(isset($param)){
            $purchases = Purchase::where('user_id',$user->id)->pluck('item_id');
            $items = Item::whereIn('id',$purchases)->get();
        } else {
            $items = Item::where('user_id',$user->id)->get();
        }
        return view('mypage',compact('user','profiles','items','param'));
    }

    // プロフィール設定の表示（初回含む）
    public function edit(){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        return view('profile_edit', compact('user','profiles'));
    }
    // プロフィール設定の新規登録
    public function store(AddressRequest $request){
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
    public function update(AddressRequest $request){
        $profiles = $request->only([
                                'user_id',
                                'post_code',
                                'address',
                                'building'
                            ]);
        $userName = $request->only(['name']);
        $use = User::find($request->user_id)->update($userName);
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
        return view('address_edit',compact('profiles'));
    }
    //配送先住所の変更
    public function addressEdit(AddressRequest $request){
        $profiles = $request->only(['post_code','address','building']);
        Address::find($request->id)->update($profiles);
        return redirect('/purchase/address');
    }

}