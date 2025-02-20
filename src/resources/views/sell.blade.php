<!-- 出品画面 -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="item-detail__group">
    <h1>商品の出品</h1>
    <div class="item-detail__img">
        <form action = "/" method = "POST" enctype="multipart/form-data">
            @csrf
            <p>商品の画像</p>
            <div class="item-detail__img-box">
                <img src="" alt="商品画像">
                <input type="file" accept="image/*" name="item_img" value="画像を選択する" >
                <button>画像を選択する</button>
            </div>
        </div>
        <h2>商品の詳細</h2>
        <p>カテゴリー</p>
            <div class="category_content">
                <input type="checkbox" id="check_input1" name="categories[]" value="1" ><label class="check_btn" for="check_input1">ファッション</label>

                <input type="checkbox" id="check_input2" name="categories[]" value="2"><label class="check_btn" for="check_input2"> 家電</label>
                <input type="checkbox" id="check_input3" name="categories[]" value="3"><label class="check_btn" for="check_input3"> インテリア</label>
                <input type="checkbox" id="check_input4" name="categories[]" value="4"><label class="check_btn" for="check_input4"> レディース</label>
                <input type="checkbox" id="check_input5" name="categories[]" value="5"><label class="check_btn" for="check_input5"> メンズ</label>
                <input type="checkbox" id="check_input6" name="categories[]" value="6"><label class="check_btn" for="check_input6"> コスメ</label>
                <input type="checkbox" id="check_input7" name="categories[]" value="7"><label class="check_btn" for="check_input7"> 本</label>
                <input type="checkbox" id="check_input8" name="categories[]" value="8"><label class="check_btn" for="check_input8"> ゲーム</label>
                <input type="checkbox" id="check_input9" name="categories[]" value="9"><label class="check_btn" for="check_input9"> スポーツ</label>
                <input type="checkbox" id="check_input10" name="categories[]" value="10"><label class="check_btn" for="check_input10"> キッチン</label>
                <input type="checkbox" id="check_input11" name="categories[]" value="11"><label class="check_btn" for="check_input11"> ハンドメイド</label>
                <input type="checkbox" id="check_input12" name="categories[]" value="12"><label class="check_btn" for="check_input12"> アクセサリー</label>
                <input type="checkbox" id="check_input13" name="categories[]" value="13"><label class="check_btn" for="check_input13"> おもちゃ</label>
                <input type="checkbox" id="check_input14" name="categories[]" value="14"><label class="check_btn" for="check_input14"> ベビー・キッズ</label>
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
                    <input class="num3" type="text" name="price" value="¥"/>
            </div>
            <div class="item-sell__button">
                <button type="submit" class="item-sell__button-submit">出品する</button>
            </div>
        </form>
</div>
@endsection
