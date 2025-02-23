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
        <a href="/"><img class="header_logo" src="{{ asset('../../img/logo.png') }}" alt="coachtech"></a>
        <ul class="header-nav">
            <ol class="header-nav__item-search">
                <form action="" method="get">
                @csrf
                    <input type="search" name="keyword" value="{{ old('keyword') }}" placeholder="  なにをお探しですか？">
                </form>
            </ol>
            @if (Auth::check())
            <ol class="header-nav__item-logout">
                <form action="/logout" method="post">
                    @csrf
                    <button>ログアウト</button>
                </form>
            </ol>
            @else
            <ol class="header-nav__item-logout">
                <form action="/login" method="get">
                    @csrf
                    <button>ログイン</button>
                </form>
            </ol>
            @endif
            <ol>
                <a class="header-nav__link-mypage" href="/mypage">マイページ</a>
            </ol>
            <ol>
                <a class="header-nav__link-sell" href="/sell">出品</a>
            </ol>
        </ul>
    </header>

    <main>
    @yield('content')
    </main>
</body>
</html>


