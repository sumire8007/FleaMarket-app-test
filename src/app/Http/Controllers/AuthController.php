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
        $address = Address::where('user_id',$user->id)->first();
        return view('profile_edit', compact('user','address'));
    }

    // プロフィール設定の新規登録
    public function create(Request $request){
        $address = $request->only(['user_id','user_img','post_code','address','building']);
        Address::create($address);
        return redirect('/');
    }


    // プロフィール設定の更新
    public function update(Request $request){
        $address = $request->only(['user_id','user_img','post_code','address','building']);
        dd($address);
        Address::find($request->id)->update($address);
        return redirect('/mypage/profile');
    }


    // public function edit(Request $request){
    //     $form = User::find($request->id);
    //     $users = User::all();
    //     return view('profile_edit', ['user' => $form]);
    // }

    //     // プロフィールの更新(初回含む)
    //     public function update(Request $request){
    //     $form = User::find($request->id);
    //     $users = User::all();
    //     Address::create($form);
    //     return redirect('/');
    // }



// ①プロフ設定の画面表示の時は、まず、外部キーのuser_nameだけを表示する
// ②updateアクションを作成し、addressesテーブルにデータを追加する
// →できる？　updateなのか？

}
