@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
<script src="https://kit.fontawesome.com/d872711579.js" crossorigin="anonymous"></script>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(Auth::check())
<style>
    .liked{
        color: #ff5555;
        transition:.2s;
    }
</style>
@endif

<style>
    /* いいね押下時の星の色 */
    .like-count-num{
        font-size: 20px;
        margin: 0 0 0 10px;
    }
    .fa-star{
        font-size: 30px;
    }
</style>
@endsection

@section('content')
<div class="item-detail__group">
    <div class="item-detail__img">
        <img src=" {{ asset('storage/'. $item->item_img) }}" alt="商品画像">
    </div>

    <article class="item-detail__content">
        <h2>{{ $item->item_name }}</h2>
        <section class="item-detail__basic">
            <p>{{ $item->brand }}</p>
            <p>{{ $item->price }}(税込)</p>
            <div class="like-comment-content">
                <div class="like-content">
                @if($item->isLikedByAuthUser())
                    <i class="fa-regular fa-star like-btn liked" id="{{$item->id}}"></i>
                @else
                    <i class="fa-regular fa-star like-btn" id="{{$item->id}}"></i>
                @endif
                    <p class="like-count-num">{{ $item->likes->count() }}</p>
                </div>
                <script>
                        const likeBtn = document.querySelector('.like-btn');
                        likeBtn.addEventListener('click',async(e)=>{
                            const clickedEl = e.target
                            clickedEl.classList.toggle('liked')
                            const itemId = e.target.id
                            const res = await fetch('/item/like',{
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ item_id: itemId })
                            })
                            .then((res)=>res.json())
                            .then((data)=>{
                                clickedEl.nextElementSibling.innerHTML = data.likesCount;
                            })
                            .catch(
                            ()=>alert('ログインが必要です'))
                        })
                </script>
                <div class="comment-content">
                    <img class="icon_comment" src="{{ asset('../../img/comment_icon.png') }}" alt="コメント">
                    <p class="comment-count-num">{{ $comments->count() }}</p>
                </div>
            </div>
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
            <div>
                <p class="condition_title">商品の状態</p>
                <p>{{ $item->condition }}</p>
            </div>
        </section>
        <section>
            <h3>コメント({{ $comments->count() }})</h3>
            @foreach($comments as $comment)
                <div class="account-box">
                    <div class="circle">
                        <img src="{{ asset('storage/' . $profiles[$comment->user_id]->user_img) }}" alt="プロフ画像">
                    </div>
                    <p>{{ $comment->user->name }}</p>
                </div>
                    <p class="comment-box">{{ $comment['comment'] }}</p>
            @endforeach
            @if (Auth::check())
                <div class="comment-box_input">
                <form action="/item" method="post">
                @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <h3>商品へのコメント</h3>
                    <textarea name="comment"></textarea>
                    <div class="comment_button">
                        <button>コメントを送信する</button>
                    <div>
                </form>
                </div>
            @else
                <div class="comment-box_input">
                <form action="/item" method="post">
                @csrf
                    <h3>商品へのコメント</h3>
                    <textarea ></textarea>
                    <div class="comment_button">
                        <button>コメントを送信する</button>
                    <div>
                </form>
                </div>
            @endif
        </section>
    </article>
</div>
@endsection