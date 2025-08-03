@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <!--おすすめの表示-->
    @if($paramUrl === false)
        <div class="item-list__tab">
            <a class="item-list__tab-active" href="/">おすすめ</a>
            @if(Auth::check() && request()->url() === url('/search'))
                <a class="item-list__tab-no-active" href="{{ url('/search') }}?user_id={{ $user->id }}&keyword={{ session('keyword') }}">マイリスト</a>
            @elseif(Auth::check())
                <a class="item-list__tab-no-active" href="{{ url('/') }}?user_id={{ $user->id }}">マイリスト</a>
            @else
                <a class="item-list__tab-no-active" href="{{ url('/') }}?user_id=">マイリスト</a>
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
    @elseif(isset($param))
        <!--マイリストの表示-->
        <div class="item-list__tab">
            <a class="item-list__tab-no-active" href="/">おすすめ</a>
            @if(Auth::check() && request()->url() === url('/search'))
                <a class="item-list__tab-active" href="{{ url('/search') }}?user_id={{ $user->id }}&keyword={{ session('keyword') }}">マイリスト</a>
                @elseif(Auth::check())
                <a class="item-list__tab-active" href="{{ url('/') }}?user_id={{ $user->id }}">マイリスト</a>
            @else
                <a class="item-list__tab-active" href="{{ url('/') }}?user_id=">マイリスト</a>
            @endif
        </div>

        <div class="item-list__content">
            <form action="/item" method="get">
                @csrf
                @if($items->isEmpty() && request()->url() === url('/search'))
                    <p>マイリストに「 {{ session('keyword') }} 」を含む商品はありません。</p>
                @elseif($items->isEmpty() && Auth::check())
                    <p>マイリストはありません</p>
                @else
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
                @endif
            </form>
        </div>
    @elseif(isset($paramUrl) && empty($param))
        <div class="item-list__tab">
            <a class="item-list__tab-no-active" href="/">おすすめ</a>
            <a class="item-list__tab-active" href="{{ url('/') }}?user_id=">マイリスト</a>
        </div>
        <div class="item-nonelist">
            <p>マイリストはありません</p>
        </div>
    @endif
@endsection