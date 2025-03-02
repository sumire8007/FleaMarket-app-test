@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@if(!isset($param))
<div class="form__group-img">
    <div class="form__group-content-img">
        <div class="circle">
            <img src="{{ asset($profiles->user_img) }}" alt="画像">
        </div>
        <div class="form__group-content-name">{{ $user->name }}</div>
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>

    <div class="item-list__tab">
        <a href="/mypage" class="item-list__tab-active">出品した商品</a>
        <a href="{{ url('/mypage') }}?id={{ $user->id }}" class="item-list__tab-no-active">購入した商品</a>
    </div>

<div class="item-list__content">
<form action="/item" method="get">
    @csrf
    @foreach($items as $item)
    <div class="item-list">
        <a href="{{ url('/item') }}?id={{ $item->id }}">
            <div class="item-list__img">
                <img src=" {{ $item->item_img }}" alt="商品画像">
            </div>

            <div class="item-list__item-name">
                <p>{{ $item->item_name }}</p>
            </div>
        </a>
    </div>
    @endforeach
</form>
</div>
@else
<div class="form__group-img">
    <div class="form__group-content-img">
        <div class="circle">
            <img src="{{ asset($profiles->user_img) }}" alt="画像">
        </div>
        <div class="form__group-content-name">{{ $user->name }}</div>
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>

    <div class="item-list__tab">
        <a href="/mypage" class="item-list__tab-no-active">出品した商品</a>
        <a href="{{ url('/mypage') }}?id={{ $user->id }}" class="item-list__tab-active">購入した商品</a>
    </div>
<div class="item-list__content">
<form action="/item" method="get">
    @csrf
    @foreach($items as $item)
    <div class="item-list">
        <a href="{{ url('/item') }}?id={{ $item->id }}">
            <div class="item-list__img">
                <img src=" {{ $item->item_img }}" alt="商品画像">
            </div>

            <div class="item-list__item-name">
                <p>{{ $item->item_name }}</p>
            </div>
        </a>
    </div>
    @endforeach
</form>
</div>
@endif
@endsection
