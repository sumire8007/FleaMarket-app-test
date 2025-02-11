<!-- 出品画面 -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="item-detail__group">
    <h1>商品の出品</h1>
    <div class="item-detail__img">
        <p>商品の画像</p>
        <div class="item-detail__img-box">
            <img src="" alt="商品画像">
            <input type="file" accept="" value="画像を選択する" >
            <button>画像を選択する</button>
        </div>
    </div>
    <h2>商品の詳細</h2>
    <p>カテゴリー</p>
        <div class="category_content">
            <label><input class="category" type="checkbox" name="" value=""> ファッション</label>
            <label><input class="category" type="checkbox" name="" value=""> 家電</label>
            <label><input class="category" type="checkbox" name="" value=""> インテリア</label>
            <label><input class="category" type="checkbox" name="" value=""> レディース</label>
            <label><input class="category" type="checkbox" name="" value=""> メンズ</label>
            <label><input class="category" type="checkbox" name="" value=""> コスメ</label>
            <label><input class="category" type="checkbox" name="" value=""> 本</label>
            <label><input class="category" type="checkbox" name="" value=""> ゲーム</label>
            <label><input class="category" type="checkbox" name="" value=""> スポーツ</label>
            <label><input class="category" type="checkbox" name="" value=""> キッチン</label>
            <label><input class="category" type="checkbox" name="" value=""> ハンドメイド</label>
            <label><input class="category" type="checkbox" name="" value=""> アクセサリー</label>
            <label><input type="checkbox" name="" value=""> おもちゃ</label>
            <label><input type="checkbox" name="" value=""> ベビー・キッズ</label>
        </div>
    <p>商品の状態</p>
        <select class="item-condition">
            <option value="">選択してください</option>
            <option value="">良好</option>
            <option value="">目立った傷や汚れなし</option>
            <option value="">やや傷や汚れあり</option>
            <option value="">状態が悪い</option>
        </select>
    <h2>商品名と説明</h2>
        <div class="item-detail">
            <p>商品名</p>
                <input type="text">
            <p>ブランド名</p>
                <input type="text">
            <p>商品の説明</p>
                <textarea name="" id="" cols="1000" rows="5"></textarea> <!--colsは文字数、rowsは行数-->
            <p>販売価格</p>
                <p class="num3" type="number">1000<p>
                <script type="text/javascript" src="../js/comma3.js" ></script>
        </div>
        <div class="item-sell__button">
            <button type="submit" class="item-sell__button-submit">出品する</button>
        </div>
</div>
@endsection
