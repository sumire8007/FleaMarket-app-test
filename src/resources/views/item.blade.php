@extends('layouts.app')

@section('css')
@endsection

@section('content')
<h1>アイテム一覧画面</h1>

<form action="/item" method="get">   <!--パラメータあってる？-->
    @csrf
    <input type="hidden" name="item_id" value="">
    <input type="image" src="" alt="商品画像" name="item_img" value="">
    <input type="text" name="item_name" value="">
</form>
@endsection