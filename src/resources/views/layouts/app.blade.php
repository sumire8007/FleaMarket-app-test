<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')

</head>
<body>
    <header>
        <a href="/"><img src="{{ asset('../../img/logo.png') }}" alt="coachtech"></a>
        <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
                <form action="/logout" method="post">
                    @csrf
                    <button>ログアウト</button>
                </form>
            </li>
            <li>
                <a class="header-nav__link" href="/mypage">マイページ</a>
            </li>
            <li>
                <a class="header-nav__link" href="/sell">出品</a>
            </li>
            @endif
        </ul>
    </header>

    <main>
    @yield('content')
    </main>
</body>
</html>