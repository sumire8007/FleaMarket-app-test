<?php

namespace App\Http\Controllers;

use AddressInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Chat;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;





class ChatController extends Controller
{
    //チャットメッセージの表示
    public function chatView(Request $request){
        $userId = Auth::user()->id;
        $loginUser = User::where('id', $userId)->with('address')->first();
        $chatFlag = $request->input('chat_flag');

        //自分が出品したもので、取引メッセージが来ているもの
        $sellItems = Item::where('user_id', $userId)->pluck('id');
        $sellChats = Chat::whereIn('item_id', $sellItems)
            ->where('completed_at', NULL)
            ->with('item')
            ->get();
        //自分がメッセージを送ってまだ完了していないもの
        $dealChats = Chat::where('user_id', $userId)
            ->where('completed_at', NULL)
            ->with('item')
            ->get();
        //「取引中の商品」に表示させるもの（自分が出品したアイテムのチャットと自分がメッセージを送ったもの）
        $allChats = $sellChats->merge($dealChats)->sortByDesc('created_at')->unique('chat_flag')->values();

        list($firstPart, $secondPart) = explode('_', $chatFlag);

        $messages = Chat::where('chat_flag', $chatFlag)->get();
        $dealItemId = $secondPart;
        $dealItem = Item::where('id', $dealItemId)->first();

        if($firstPart === $loginUser->id){
            $dealItemId = $secondPart;
            $dealUser = Item::where('id', $dealItemId)->with('user')->first();
            $profiles = Address::where('id',$dealUser->user_id)->first();
            return view('chat', compact('loginUser', 'messages', 'dealUser', 'dealItem', 'profiles', 'chatFlag', 'firstPart','allChats'));

        }elseif($firstPart !== $loginUser->id){
            $dealUserId = $firstPart;
            $dealUser = User::where('id', $dealUserId)->with('address')->first();
            return view('chat', compact('loginUser', 'messages', 'dealUser', 'dealItem', 'chatFlag', 'firstPart', 'allChats'));
        }
    }
    //メッセージの送信
    public function sendMessage(Request $request){
        $chatFlag = $request->input('chat_flag');
        $message = $request->only([
            'user_id',
            'item_id',
            'chat_flag',
            'message',
        ]);
        if ($request->hasFile('user_img')) {
            $image = $request->file('user_img');
            $image_url = Storage::disk('public')->put('users', $image);
            $profiles['user_img'] = $image_url;
        }
        Chat::create($message);
        return (redirect('chat?chat_flag='.$chatFlag));
    }

}
