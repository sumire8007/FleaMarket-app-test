@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<!-- プロフ画像 -->
<div class="form__group-img">
    <div class="form__group-content-img">
        <div class="circle">
            <img src="" alt="画像">
        </div>
        <div class="form__group-content-name">ユーザー名</div>
        <form action="/mypage/profile" method="get">
            @csrf
            <button class="img_select-button">プロフィールを編集</button>
        </form>
    </div>
</div>


    <div class="item-list__tab">
        <a href="/">出品した商品</a>
        <form action="/" method="get">
            @csrf
            <input type="submit" value="購入した商品" >
        </form>
    </div>

<div class="item-list__content">
<form action="/item" method="get">   <!--パラメータあってる？-->
    @csrf
    <div class="item-list">
        <input type="hidden" name="" value="">
        <div class="item-list__img">
            <input type="image" src="" alt="商品画像" name="" readonly />
        </div>
        <div class="item-list__item-name">
            <input type="text" name="" value="商品名" readonly />
        </div>
    </div>
    <div class="item-list">
        <input type="hidden" name="" value="">
        <div class="item-list__img">
            <input type="image" src="" alt="商品画像" name="" readonly />
        </div>
        <div class="item-list__item-name">
            <input type="text" name="" value="商品名" readonly />
        </div>
    </div>
    <div class="item-list">
        <input type="hidden" name="" value="">
        <div class="item-list__img">
            <input type="image" src="" alt="商品画像" name="" readonly />
        </div>
        <div class="item-list__item-name">
            <input type="text" name="" value="商品名" readonly />
        </div>
    </div>
    <div class="item-list">
        <input type="hidden" name="" value="">
        <div class="item-list__img">
            <input type="image" src="" alt="商品画像" name="" readonly />
        </div>
        <div class="item-list__item-name">
            <input type="text" name="" value="商品名" readonly />
        </div>
    </div>
    <div class="item-list">
        <input type="hidden" name="" value="">
        <div class="item-list__img">
            <input type="image" src="" alt="商品画像" name="" readonly />
        </div>
        <div class="item-list__item-name">
            <input type="text" name="" value="商品名" readonly />
        </div>
    </div>

</form>
</div>
@endsection
