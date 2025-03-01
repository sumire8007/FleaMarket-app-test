@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
<script src="https://kit.fontawesome.com/d872711579.js" crossorigin="anonymous"></script>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- {{-- csrfトークン --}} -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script src="{{ asset('../../img/ster_icon.png') }}" crossorigin="anonymous"></script> -->

<style>
    /* いいね押下時の星の色 */
    .liked{
        color: #ff5555;
        transition:.2s;
    }
    .count-num{
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
        <img src=" {{ $item->item_img }}" alt="商品画像">
    </div>

    <article class="item-detail__content">
        <h2>{{ $item->item_name }}</h2>
        <section class="item-detail__basic">
            <p>{{ $item->brand }}</p>
            <p>{{ $item->price }}(税込)</p>
                <div class="flexbox">
                @if($item->isLikedByAuthUser())
                    <i class="fa-regular fa-star like-btn liked" id="{{$item->id}}"></i>
                @else
                    <i class="fa-regular fa-star like-btn" id="{{$item->id}}"></i>
                @endif
                    <p class="count-num">{{ $item->likes->count() }}</p>
                </div>

<script>
    //いいねボタンのhtml要素を取得します。
        const likeBtn = document.querySelector('.like-btn');
        //いいねボタンをクリックした際の処理を記述します。
        likeBtn.addEventListener('click',async(e)=>{
            //クリックされた要素を取得しています。
            const clickedEl = e.target
            //クリックされた要素にlikedというクラスがあれば削除し、なければ付与します。これにより星の色の切り替えができます。
            clickedEl.classList.toggle('liked')
            //記事のidを取得しています。
            const itemId = e.target.id
            //fetchメソッドを利用し、バックエンドと通信します。
            const res = await fetch('/item/like',{
                //リクエストメソッドはPOST
                method: 'POST',
                headers: {
                    //Content-Typeでサーバーに送るデータの種類を伝える。今回はapplication/json
                    'Content-Type': 'application/json',
                    //csrfトークンを付与
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                //バックエンドにいいねをした記事のidを送信します。
                body: JSON.stringify({ item_id: itemId })
            })
            .then((res)=>res.json())
            .then((data)=>{
                //記事のいいね数がバックエンドからlikesCountという変数に格納されて送信されるため、それを受け取りビューに反映します。
                clickedEl.nextElementSibling.innerHTML = data.likesCount;
            })
            .catch(
            //処理がなんらかの理由で失敗した場合に実施したい処理を記述します。
            ()=>alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'))

        })
    </script>


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
            <form action="/item" method="post">
            @csrf
                @if(Auth::check())
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @endif
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <h3>商品へのコメント</h3>
                <textarea name="comment"></textarea>
                <div class="comment_button">
                    <button>コメントを送信する</button>
                </div>
            </form>
            </div>
        </section>
    </article>
</div>
@endsection