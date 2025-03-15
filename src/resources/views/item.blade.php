@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <!--おすすめの表示-->
    @if(!isset($param))
            <div class="item-list__tab">
                <a class="item-list__tab-active" href="/">おすすめ</a>
                @if(Auth::check())
                <a class="item-list__tab-no-active" href="{{ url('/') }}?id={{ $user->id }}">マイリスト</a>
                @else
                    <a class="item-list__tab-no-active" href="{{ url('/') }}?id=">マイリスト</a>
                @endif

            </div>

        <div class="item-list__content">
        <form action="/item" method="get">
            @csrf
            @foreach($items as $item)
            <div class="item-list">
                <a href="{{ url('/item') }}?id={{ $item->id }}">
                    @if(isset($sold) && in_array($item->id, $sold->toArray()))
                    <div class="item-list__img-sold">
                        <img src=" {{ 'storage/' . $item->item_img }}" alt="商品画像">
                        <p>sold</p>
                    </div>
                    @else
                    <div class="item-list__img">
                        <img src=" {{ 'storage/' . $item->item_img }}" alt="商品画像">
                    </div>
                    @endif
                    <div class="item-list__item-name">
                        <p>{{ $item->item_name }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </form>
        </div>
    @else
        <!--マイリストの表示-->
                <div class="item-list__tab">
                    <a class="item-list__tab-no-active" href="/">おすすめ</a>
                    @if(Auth::check())
                    <a class="item-list__tab-active" href="{{ url('/') }}?id={{ $user->id }}">マイリスト</a>
                    @else
                        <a class="item-list__tab-active" href="{{ url('/') }}?id=">マイリスト</a>
                    @endif
                </div>

            <div class="item-list__content">
            <form action="/item" method="get">
                @csrf
                @foreach($items as $item)
                <div class="item-list">
                    <a href="{{ url('/item') }}?id={{ $item->id }}">
                        @if(isset($sold) && in_array($item->id, $sold->toArray()))
                        <div class="item-list__img-sold">
                            <img src=" {{ 'storage/' . $item->item_img }}" alt="商品画像">
                            <p>sold</p>
                        </div>
                        @else
                        <div class="item-list__img">
                            <img src=" {{ 'storage/' . $item->item_img }}" alt="商品画像">
                        </div>
                        @endif

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