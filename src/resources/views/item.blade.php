@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <div class="item-list__tab">
        <a href="/">おすすめ</a>
        <form action="/" method="get">
            @csrf
            <input type="submit" value="マイリスト" >
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

