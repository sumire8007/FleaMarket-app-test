<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\ItemLike;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeItem(Request $request)
    {
        $user_id = \Auth::id();
        $item_id = $request->item_id;
        $alreadyLiked = ItemLike::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if (!$alreadyLiked) {
            $like = new ItemLike();
            $like->item_id = $item_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            ItemLike::where('item_id', $item_id)->where('user_id', $user_id)->delete();
        }
        $item = Item::where('id', $item_id)->first();
        $likesCount = $item->likes->count();

        $param = [
            'likesCount' =>  $likesCount,
        ];
        return response()->json($param);
    }
}
