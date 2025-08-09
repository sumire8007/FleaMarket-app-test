<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function chatView(){
        $user = Auth::user();
        return view('chat',compact('user'));
    }
}
