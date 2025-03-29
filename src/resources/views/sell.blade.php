<!-- 出品画面 -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <div class="item-detail__group">
        <h1>商品の出品</h1>
        <div class="item-detail__img">
            <form action = "/sell" method = "POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <p>商品の画像</p>
                <div class="item-detail__img-box">
                    <input class="img_select-button"  type="file" accept="image/*" name="item_img" value="画像を選択する" >
                </div>
                @error('item_img')
                    <span class="error-message">{{ $message }}</span>
                @enderror
        </div>
            <h2>商品の詳細</h2>
            <p>カテゴリー</p>
                <div class="category_content">
                    @foreach($categories as $category)
                    <input type="checkbox" id="check_input{{ $category['id'] }}" name="categories[]" value="{{ $category['id'] }}">
                    <label class="check_btn" for="check_input{{ $category['id'] }}">
                        {{ $category['content'] }}
                    </label>
                    @endforeach
                </div>
                @error('categories')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            <p>商品の状態</p>
                <select class="item-condition" name="condition">
                    <option value="">選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
                @error('condition')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            <h2>商品名と説明</h2>
                <div class="item-detail">
                    <p>商品名</p>
                        <input type="text" name="item_name" value="{{ old('item_name') }}" >
                        @error('item_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    <p>ブランド名</p>
                        <input type="text" name="brand" value="{{ old('brand') }}">
                    <p>商品の説明</p>
                        <textarea name="detail" value="{{ old('detail') }}"></textarea>
                    @error('detail')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <p>販売価格</p>
                        <input class="price" type="text" name="price" value="{{ old('price') }}"/>
                        @error('price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                </div>
                <div class="item-sell__button">
                    <button type="submit" class="item-sell__button-submit">出品する</button>
                </div>
            </form>
    </div>
@endsection
