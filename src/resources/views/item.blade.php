@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <div class="item-list__tab">
        <a class="item-list__tab-active" href="/">おすすめ</a>
        @if(Auth::check())
        <a class="item-list__tab-no-active" href="{{ url('/myList') }}?id={{ $user->id }}">マイリスト</a>
        @else
        <a class="item-list__tab-no-active" href="/myList">マイページ</a>
        @endif
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
@endsection

