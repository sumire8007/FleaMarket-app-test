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
            <!-- @if (Auth::check()) -->
            <ol class="header-nav__item-search">
                <form action="" method="get">
                @csrf
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="  なにをお探しですか？">
                </form>
            </ol>
            <ol class="header-nav__item-logout">
                <form action="/logout" method="post">
                    @csrf
                    <button>ログアウト</button>
                </form>
            </ol>
            <ol>
                <a class="header-nav__link-mypage" href="/mypage">マイページ</a>
            </ol>
            <ol>
                <a class="header-nav__link-sell" href="/sell">出品</a>
            </ol>
            <!-- @endif -->
        </ul>
    </header>

    <main>
    @yield('content')
    </main>
</body>
</html>