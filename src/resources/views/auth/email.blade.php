<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/email.css') }}" />
</head>

<body>
    <header>
        <img src="{{ asset('../../img/logo.png') }}" alt="coachtech">
    </header>

    <main>
        @if(session('message'))
            <div class="resend-message">{{ session('message') }}</div>
        @endif
        <div class="email-form__content">
            <p>登録していただいたメールアドレスに認証メールを送信しました。</p>
            <p>メール認証を完了してください</p>
                <button class="email-form__button">
                    <a href="http://localhost:8025">認証はこちらから</a>
                </button>
            <form action="/email/resend" method="post">
                @csrf
                <button class="resend-link">認証メールを再送する</button>
            </form>
        </div>
    </main>
</body>

</html>