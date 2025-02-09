@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')
<!-- <form action="" method="get">
    @csrf
    <input type="hidden" name="item_id" value="">
    <input type="image" src="" alt="商品画像" name="item_img" value="">
    <input type="text" name="item_name" value="">
</form> -->


<div class="item-detail__group">
    <div class="item-detail__img">
        <img src="" alt="商品画像">
    </div>

    <article class="item-detail__content">
        <h2>商品名がここに入る</h2>
        <section class="item-detail__basic">
            <p>ブランド名</p>
            <p>¥47,000(税込)</p>
            <p class="ster_icon">☆</p>
            <p class="comment_icon">⚪︎</p>
        </section>
        <form action="/purchase" name="" value="">
            <input type="hidden" name="" value="">
            <button>購入手続きへ</button>
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
            <p>カテゴリー</p>
            <p>商品の状態</p>
        </section>
        <section>
            <h3>コメント(1)</h3>
            <img src="" alt="プロフ画像">
            <p>admin</p>
            <p>こちらにコメントが入ります。</p>
        <form action="">
            <p>商品へのコメント</p>
            <textarea name="comment" id="">
            </textarea>
            <button>コメントを送信する</button>
        </form>
        </section>
    </article>
</div>
@endsection