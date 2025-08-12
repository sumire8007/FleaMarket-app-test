<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Chat;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;
use App\Models\Rating;



class ChatController extends Controller
{
    //チャットメッセージの表示
    public function chatView(Request $request){
        $userId = Auth::user()->id;
        $loginUser = User::where('id', $userId)->with('address')->first();
        $chatFlag = $request->input('chat_flag');
        // 未読を既読に更新（チャットページを開いた時点で’is_read’カラムが空のものを更新）
        $read = Chat::where('chat_flag', $chatFlag)
            ->where('user_id','!=', $userId)
            ->where('is_read', 'unread')
            ->update(['is_read' => 'reade']);

        //自分が出品したもので、取引メッセージが来ているもの && 評価が済んでいないもの
        $sellItems = Item::where('user_id', $userId)->pluck('id');
        $sellChatUnRating = Rating::where('from_user_id',$userId)
        ->pluck('item_id');
        $sellChats = Chat::whereIn('item_id',$sellItems)
            ->whereNotIn('item_id',$sellChatUnRating)
            ->with('item')
            ->get();
        //自分がメッセージを送ってまだ完了していないもの
        $dealChats = Chat::where('user_id', $userId)
            ->where('completed_at', NULL)
            ->with('item')
            ->get();
        //サイドバー「その他の取引」に表示させるもの（合算、自分が出品したアイテムのチャットと自分がメッセージを送ったもの）
        $allChats = $sellChats->merge($dealChats)->sortByDesc('created_at')->unique('chat_flag')->values();

        list($firstPart, $secondPart) = explode('_', $chatFlag);
        $messages = Chat::where('chat_flag', $chatFlag)->get();
        $dealItemId = $secondPart;
        $dealItem = Item::where('id', $dealItemId)->first();

        if($firstPart == $loginUser->id){
            $dealUser = Item::where('id', $dealItemId)->with('user')->first();
            $profiles = Address::where('id',$dealUser->user_id)->first();
            $rating = Rating::where('item_id', $dealItemId)
                ->where('from_user_id', $loginUser->id)->first();
            return view('chat', compact('loginUser', 'messages', 'dealUser', 'dealItem', 'profiles', 'chatFlag', 'firstPart','allChats','rating'));
        }elseif($firstPart !== $loginUser->id){
            $dealUserId = $firstPart;
            $dealUser = User::where('id', $dealUserId)->with('address')->first();
            return view('chat', compact('loginUser', 'messages', 'dealUser', 'dealItem', 'chatFlag', 'firstPart', 'allChats'));
        }
    }
    //メッセージの送信
    public function sendMessage(ChatRequest $request){
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

    //取引完了
    // public function completed(Request $request)
    // {
    //     $loginUser = Auth::user();
    //     $chatFlag = $request->input('chat_flag');
    //     Chat::where('chat_flag', $chatFlag)
    //     ->update(['completed_at'=>Carbon::now()]);
    //     return back()->with('showModal', true);
    // }

    //評価送信
    public function store(Request $request)
    {
        $loginUser = Auth::user();
        Rating::create([
            'from_user_id' => $loginUser->id,
            'to_user_id' => $request->to_user_id,
            'item_id' => $request->item_id,
            'stars' => $request->stars
        ]);
        $chatFlag = $request->input('chat_flag');
        Chat::where('chat_flag', $chatFlag)
        ->update(['completed_at'=>Carbon::now()]);
        return redirect('/')->with('success','評価を送信しました');
    }
}
