@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')

<div class="item-detail__group">
    <div class="item-detail__img">
        <img src=" {{ $item->item_img }}" alt="商品画像">
    </div>

    <article class="item-detail__content">
        <h2>{{ $item->item_name }}</h2>
        <section class="item-detail__basic">
            <p>{{ $item->brand }}</p>
            <p>{{ $item->price }}(税込)</p>
            <input class="icon_ster" type="image" src="{{ asset('../../img/ster_icon.png') }}" alt="いいね">
            <input class="icon_comment" type="image" src="{{ asset('../../img/comment_icon.png') }}" alt="コメント">
        </section>
        <form action="/purchase" method="get">
        @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <a class="buy_button" href="{{ url('/purchase') }}?id={{ $item['id'] }}">購入手続きへ</a>
        </form>
        <section class="item-detail__explanation">
            <h3>商品説明</h3>
            <p>{{ $item->detail }}</p>
        </section>
        <section class="item-detail__information">
            <h3>商品の情報</h3>

            <div class="category_box">
                <p class="category_title">カテゴリー</p>
                @foreach($item->categories as $category)
                <p class="category_item">{{ $category['content'] }}</p>
                @endforeach
            </div>
            <div >
                <p class="condition_title">商品の状態</p>
                <p>{{ $condition->condition }}</p>
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