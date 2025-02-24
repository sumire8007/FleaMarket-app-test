<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;

class AuthController extends Controller
{
    // プロフィール設定の表示（初回含む）
    public function edit(){
        $user = Auth::user();
        $profiles = Address::where('user_id',$user->id)->first();
        return view('profile_edit', compact('user','profiles'));
    }
    // プロフィール設定の新規登録
    public function store(Request $request){
        $profiles = $request->only(['user_id','user_img','post_code','address','building']);
        Address::create($profiles);
        return redirect('/');
    }
    // プロフィール設定の更新
    public function update(Request $request){
        $profiles = $request->only(['user_id','user_img','post_code','address','building']);
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
    public function addressEdit(Request $request){
        $profiles = $request->only(['post_code','address','building']);
        Address::find($request->id)->update($profiles);
        return redirect('/purchase/address');
    }

}
