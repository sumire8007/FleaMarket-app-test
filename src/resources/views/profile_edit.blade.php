<!-- 会員登録後に遷移してくる画面 住所の入力(初回) -->
@extends('layouts.app')

@section('css')
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>プロフィール設定</h2>
    </div>

    <div class="contact-form__input">
    <form class="form" action="/" method="post">
        @csrf
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
        <!-- メールアドレスのフォーム -->
        <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
                <input type="email" name="email" value="{{ old('email') }}"/>
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        </div>
        <!-- パスワードのフォーム -->
        <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
            <input type="password" name="password" value="{{ old('password') }}"/>
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        </div>
        <!-- 確認用パスワードのフォーム -->
        <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">確認用パスワード</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
            <input type="password" name="password_confirmation"/>
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        </div>

        <!-- 登録するをクリックするとプロフィール設定画面に遷移 -->
        <div class="form__button">
        <button class="form__button-submit" type="submit">登録する</button>
        </div>
        <a href="/login">ログインはこちら</a>
    </form>
</div>
</div>

@endsection