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
        <div class="email-form__content">
            <p>登録していただいたメールアドレスに認証メールを送信しました。</p>
            <p>メール認証を完了してください</p>
            <div class="email-form__button">
                <button>
                    <a href="http://localhost:8025">認証はこちらから</a>
                </button>
            </div>
            <form action="/email/resend" method="post">
                @csrf
                <button>認証メールを再送する</button>
            </form>
        </div>
    </main>
</body>

</html>