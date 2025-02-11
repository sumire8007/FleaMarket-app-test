<!-- 配送先の住所変更 -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address_edit.css') }}" />
@endsection

@section('content')
<div class="address_edit-form__content">
    <div class="profile_edit-form__heading">
        <h2>住所の変更</h2>
    </div>

    <div class="address_edit-form__input">
    <form class="form" action="" method="post">
        @csrf
        <!-- 郵便番号 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" value="{{ old('email') }}"/>
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- 住所 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="password" value="{{ old('password') }}"/>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- 建物名 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="password_confirmation"/>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- 更新するをクリックすると商品一覧画面に遷移 -->
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
</div>

@endsection