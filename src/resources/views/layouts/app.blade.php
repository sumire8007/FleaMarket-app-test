<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
    @livewireStyles
</head>
<body>
    <header>
        <a class="header_logo" href="/"><img  src="{{ asset('../../img/logo.png') }}" alt="coachtech"></a>
        <div class="header-content">
            <div class="header-item-search">
                <form action="/search" method="post">
                @csrf
                    <input type="search" name="keyword" value="{{ old('keyword') }}" placeholder="  なにをお探しですか？">
                </form>
            </div>
            <!-- <nav> -->
                <ul class="header-nav">
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
            <!-- </nav> -->
        </div>
    </header>

    <main>
    @yield('content')
    </main>
@livewireScripts
</body>
</html>


