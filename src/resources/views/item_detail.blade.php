@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')

<div class="item-detail__group">
    <div class="item-detail__img">
        <img src="" alt="商品画像">
    </div>

    <article class="item-detail__content">
        <h2>商品名がここに入る</h2>
        <section class="item-detail__basic">
            <p>ブランド名</p>
            <p>¥47,000(税込)</p>
            <input class="icon_ster" type="image" src="{{ asset('../../img/ster_icon.png') }}" alt="いいね">
            <input class="icon_comment" type="image" src="{{ asset('../../img/comment_icon.png') }}" alt="コメント">
        </section>
        <form action="/purchase" name="" value="">
            <input type="hidden" name="" value="">
            <button class="buy_button">購入手続きへ</button>
        </form>
        <section class="item-detail__explanation">
            <h3>商品説明</h3>
            <p>カラー：グレー</p>
            <p>新品</p>
            <p name="" id="">
                商品の状態は良好です。傷もありません。
                購入後、即発送いたします。
            </p>
        </section>
        <section class="item-detail__information">
            <h3>商品の状態</h3>
            <div>
                <p class="category_title">カテゴリー</p>
                <input class="category" type="text" value="洋服" >
                <input class="category" type="text" value="メンズ">
            </div>
            <div>
                <p class="condition_title">商品の状態</p>
                <input class="condition" value="良好" readonly />
            </div>
        </section>
        <section>
            <h3>コメント(1)</h3>
            <div class="account-box">
                <img src="" alt="プロフ画像">
                <p>admin</p>
            </div>
            <p class="comment-box">こちらにコメントが入ります。</p>
            <div class="comment-box_input">
            <form action="">
                <h3>商品へのコメント</h3>
                <textarea name="comment" id=""></textarea>
                <div class="comment_button">
                    <button>コメントを送信する</button>
                </div>
            </form>
            </div>
        </section>
    </article>
</div>
@endsection