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
        //自身がいいね済みなのか判定します
        $alreadyLiked = ItemLike::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if (!$alreadyLiked) {
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $like = new ItemLike();
            $like->item_id = $item_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            ItemLike::where('item_id', $item_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $item = Item::where('id', $item_id)->first();
        $likesCount = $item->likes->count();

        $param = [
            'likesCount' =>  $likesCount,
        ];
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);

    }
}
