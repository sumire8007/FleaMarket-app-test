<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;


class ChatController extends Controller
{
    public function chatView(Request $request){
        $user = Auth::user();
        $flag = $request->user_id.'_'.$request->item_id;
        Chat::where('chat_flag', $flag)->get();
        return view('chat',compact('user'));
    }
}
