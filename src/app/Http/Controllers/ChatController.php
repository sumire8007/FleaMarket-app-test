<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Chat;
use App\Models\User;
use App\Models\Item;




class ChatController extends Controller
{
    //チャットメッセージの表示
    public function chatView(Request $request){
        $userId = Auth::user()->id;
        $loginUser = User::where('id', $userId)->with('address')->first();
        $chatFlag = $request->input('chat_flag');
        $messages = Chat::where('chat_flag', $chatFlag)->get();

        list($firstPart, $secondPart) = explode('_', $chatFlag);
        $dealUserId = $firstPart;
        $dealUser = User::where('id', $dealUserId)->with('address')->first();

        $dealItemId = $secondPart;
        $dealItem = Item::where('id', $dealItemId)->first();

        return view('chat',compact('loginUser','messages','dealUser','dealItem','chatFlag'));
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
