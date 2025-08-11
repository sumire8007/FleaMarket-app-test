@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    @if(request()->routeIs('mypage')) <!--出品した商品-->
        <div class="form__group-img">
            <div class="form__group-content-img">
                <div class="circle">
                    @if(empty($profiles->user_img))
                        <img src="img/default_user_img.png" alt="">
                    @else
                        <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="画像">
                    @endif
                </div>
                <div class="form__group-content-name">{{ $user->name }}</div>
                <a href="/mypage/profile" class="profile-edit__button">プロフィールを編集</a>
            </div>
        </div>
            <div class="mypage__tab">
                <a href="/mypage" class="mypage__tab-active">出品した商品</a>
                <a href="/mypage/buy" class="mypage__tab-no-active">購入した商品</a>
                <a href="/mypage/deal" class="mypage__tab-no-active">取引中の商品</a>
                @if($badge > 0)
                    <span class="badge">{{ $badge }}</span>
                @endif
            </div>
        <div class="mypage__content">
            @foreach($items as $item)
                <div class="mypage-item-box">
                    <a href="{{ url('/item') }}?id={{ $item->id }}">
                        <div class="mypage-item-box__img">
                            <img src=" {{ asset('storage/' . $item->item_img) }}" alt="商品画像">
                        </div>
                        <div class="mypage-item-box-name">
                            <p>{{ $item->item_name }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @elseif(request()->routeIs('mypage.buy'))<!--購入した商品-->
        <div class="form__group-img">
            <div class="form__group-content-img">
                <div class="circle">
                    @if(empty($profiles->user_img))
                        <img src="/img/default_user_img.png" alt="">
                    @else
                        <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="画像">
                    @endif

                </div>
                <div class="form__group-content-name">{{ $user->name }}</div>
                <a href="/mypage/profile" class="profile-edit__button">プロフィールを編集</a>
            </div>
        </div>

            <div class="mypage__tab">
                <a href="/mypage" class="mypage__tab-no-active">出品した商品</a>
                <a href="/mypage/buy" class="mypage__tab-active">購入した商品</a>
                <a href="/mypage/deal" class="mypage__tab-no-active">取引中の商品</a>
                @if($badge > 0)
                    <span class="badge">{{ $badge }}</span>
                @endif
            </div>
        <div class="mypage__content">
            @foreach($items as $item)
                <div class="mypage-item-box">
                    <a href="{{ url('/chat') }}?chat_flag={{ $user->id . '_' . $item->id }}">
                        <div class="mypage-item-box__img">
                            <img src=" {{ asset('storage/' . $item->item_img) }}" alt="商品画像">
                        </div>

                        <div class="mypage-item-box__item-name">
                            <p>{{ $item->item_name }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @elseif(request()->routeIs('mypage.deal')) <!--取引中の商品-->
        <div class="form__group-img">
            <div class="form__group-content-img">
                <div class="circle">
                    @if(empty($profiles->user_img))
                        <img src="/img/default_user_img.png" alt="">
                    @else
                        <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="画像">
                    @endif
                </div>
                <div class="form__group-content-name">{{ $user->name }}</div>
                <a href="/mypage/profile" class="profile-edit__button">プロフィールを編集</a>
            </div>
        </div>

        <div class="mypage__tab">
            <a href="/mypage" class="mypage__tab-no-active">出品した商品</a>
            <a href="/mypage/buy" class="mypage__tab-no-active">購入した商品</a>
            <a href="/mypage/deal" class="mypage__tab-active">取引中の商品</a>
            @if($badge > 0)
                <span class="badge">{{ $badge }}</span>
            @endif
        </div>
        <div class="mypage__content">
            @foreach($items as $item)
                @php
                $itemBadge = App\Models\Chat::where('chat_flag', $item->chat_flag)
                    ->where('user_id', '!=', $user->id)
                    ->where('is_read','unread')
                    ->count();
                @endphp


                            <div class="mypage-item-box">
                                <a href="{{ url('/chat') }}?chat_flag={{ $item->chat_flag }}">
                                    <div class="mypage-item-box__img">
                                        <img src=" {{ asset('storage/' . $item->item->item_img) }}" alt="商品画像">
                                        @if ($itemBadge > 0)
                                            <span class="item-badge">{{ $itemBadge }}</span>
                                        @endif
                                    </div>
                                    <div class="mypage-item-box__item-name">
                                        <p>{{ $item->item->item_name }}</p>
                                    </div>
                                </a>
                            </div>
            @endforeach
        </div>
    @endif
@endsection
