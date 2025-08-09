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
                @if(Illuminate\Support\Facades\Auth::check())
                    <form action="/search?user_id={{ $user->id }}&keyword={{ session('keyword') }}" method="get">
                @else
                    <form action="/search?keyword={{ session('keyword') }}" method="get">
                @endif
                @csrf
                    <input type="search" name="keyword" value="{{ session('keyword') }}" placeholder="  なにをお探しですか？">
                </form>
            </div>
                <ul class="header-nav">
                    @if (Illuminate\Support\Facades\Auth::check())
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
        </div>
    </header>

    <main>
    @yield('content')
    </main>
@livewireScripts
</body>
</html>


