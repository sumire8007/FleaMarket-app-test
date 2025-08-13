<?php

namespace App\Http\Controllers;

use App\Models\ChatDraft;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatDraftController extends Controller
{
    //入力値を保存
    public function save(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'message' => 'nullable|string',
        ]);
        ChatDraft::updateOrCreate([    //すでに既存のデータがあればそこを上書き
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
        ], [
            'message' => $request->message,
        ]);
        return response()->json(['status' => 'OK']);
    }
    // 入力値が送信されたら、空にする
    public function delete(Request $request)
    {
        ChatDraft::where('user_id', Auth::id())
            ->where('item_id', $request->item_id)
            ->update(['message' => NULL]);
        return response()->json(['status' => 'NULL_OK']);
    }

    //保存されている入力値を取得
    public function get(Request $request,$itemId)
    {
        $draft = ChatDraft::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->first();
        return response()->json(['message' => $draft->message ?? '']);
    }
}
