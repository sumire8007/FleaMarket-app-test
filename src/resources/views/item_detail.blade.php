@extends('layouts.app')

@section('css')
@endsection

@section('content')
<h1>アイテム詳細画面</h1>

<!-- <form action="" method="get">
    @csrf
    <input type="hidden" name="item_id" value="">
    <input type="image" src="" alt="商品画像" name="item_img" value="">
    <input type="text" name="item_name" value="">
</form> -->


<form action="/purchase" name="" value="">
    <input type="hidden" name="" value="">
    <button>購入手続きへ</button>
</form>

<form action="">
    <p>商品へのコメント</p>
    <textarea name="comment" id="">
    </textarea>
    <button>コメントを送信する</button>
</form>

@endsection