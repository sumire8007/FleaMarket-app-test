<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
</head>
<body>
    <header>
        <img src="{{ asset('../../img/logo.png') }}" alt="coachtech">
    </header>

    <main>
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
                <a class="transition" href="/register">会員登録はこちら</a>
            </form>
        </div>

    </main>
</body>
</html>