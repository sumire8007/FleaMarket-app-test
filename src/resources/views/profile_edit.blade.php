<!-- 会員登録後に遷移してくる画面 住所の入力(初回) -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}" />
@endsection

@section('content')

<div class="profile_edit-form__content">
    <div class="profile_edit-form__heading">
        <h2>プロフィール設定</h2>
    </div>

    <div class="profile_edit-form__input">
    <form class="form" action="/" method="post">
        @csrf
        <!-- プロフ画像 -->
        <div class="form__group-img">
            <div class="form__group-content-img">
                <div class="circle">
                    <img src="" alt="画像">
                </div>
                <button class="img_select-button">画像を選択する</button>
            </div>
        </div>
        <!-- ユーザー名 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}"/>
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
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