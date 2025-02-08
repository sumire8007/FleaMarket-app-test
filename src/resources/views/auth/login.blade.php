@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-form__heading">
        <h2>ログイン</h2>
    </div>

    <div class="login-form__input">
    <form class="form" action="/login" method="post">
        @csrf
        <!-- メールアドレスのフォーム -->
        <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">ユーザー名/メールアドレス</span>
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
            <input type="password" name="password"/>
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        </div>
        <!-- ログインするをクリックすると商品一覧画面(トップ)に遷移 -->
        <div class="form__button">
        <button class="form__button-submit" type="submit">ログインする</button>
        </div>
        <a href="/register">会員登録はこちら</a>
    </form>
</div>
</div>

@endsection