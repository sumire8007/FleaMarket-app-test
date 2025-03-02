@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
@if(Auth::check())
    <div class="item-list__tab">
        <a href="/" class="item-list__tab-no-active">おすすめ</a>
        <a href="{{ url('/myList') }}?id={{ $user->id }}" class="item-list__tab-active">マイページ</a>
    </div>
    <div class="item-list__content">
    <form action="/item" method="get">
        @csrf
        @foreach($items as $item)
        <div class="item-list">
            <a href="{{ url('/item') }}?id={{ $item->id }}">
                <div class="item-list__img">
                    <img src=" {{ $item->item_img}}" alt="商品画像">
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
    <div class="item-list__tab">
        <a class="item-list__tab-no-active" href="/">おすすめ</a>
        <a class="item-list__tab-active" href="/myList">マイリスト</a>
    </div>

<h3>ログインしてください</h3>
@endif
@endsection

