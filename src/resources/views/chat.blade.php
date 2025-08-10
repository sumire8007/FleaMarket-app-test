<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}"/>
</head>
<body>
    <header class="logo">
        <a href="/mypage/deal">
        <img src="{{ asset('../../img/logo.png') }}" alt="coachtech">
        </a>
    </header>
    <div class="content">
        <aside>
            <div class="side">
                その他の取引
                @foreach ($allChats as $allChat)
                    <a href="{{ url('/chat') }}?chat_flag={{ $allChat->chat_flag }} ">
                        <div class="other-chat">
                            {{ $allChat->item->item_name}}
                        </div>
                    </a>
                @endforeach

            </div>
        </aside>
        <main>
            <!-- チャットのタイトル　取引相手の名 と　取引相手のプロフ画像-->
            <div class="deal_user">
                @if($firstPart === $loginUser->id) <!--出品者へメッセージ-->
                    <div class="circle">
                        @if (!empty($profiles->user_img))
                            <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="プロフ画像">
                        @else
                            <img src="../img/default_user_img.png" alt="">
                        @endif
                    </div>
                    <div class="title_content">
                        <div class="title">
                            <p>{{ $dealUser->user->name }} さんとの取引画面</p>
                        </div>
                        <form action="">
                            @csrf
                            <button class="completed_btm">取引を完了する</button>
                        </form>
                    </div>
                @elseif($firstPart !== $loginUser->id)<!--購入者へメッセージ-->
                    <div class="circle">
                        @if (!empty($dealUser->address->user_img))
                            <img src="{{ asset('storage/' . $dealUser->address->user_img) }}" alt="プロフ画像">
                        @else
                            <img src="../img/default_user_img.png" alt="">
                        @endif
                    </div>
                    <div class="title_content">
                        <div class="title">
                            <p>{{ $dealUser->name }} さんとの取引画面</p>
                        </div>
                        <form action="">
                            @csrf
                            <button class="completed_btm">取引を完了する</button>
                        </form>
                    </div>
                @endif

            </div>
            <!-- 商品の詳細 -->
            <div class="item_content">
                <div class="item_img">
                    <img src="{{ asset('storage/' . $dealItem->item_img) }}" alt="商品画像">
                </div>
                <div class="item_detail">
                    <div>
                        <div class="item_name">
                            <p>{{ $dealItem->item_name }}</p>
                        </div>
                        <div class="item_price">
                            <p>¥{{ number_format($dealItem->price) }}</p>
                        </div>
                    </div>
                </div>
            </div>
    <!-- ここでウィンドウ固定を入れる -->
            <!-- メッセージの画面 -->
            @if($firstPart === $loginUser->id) <!--出品者へメッセージ-->
            <div class="chat_content">
                <!-- メッセージ相手 -->
                @foreach($messages as $message)
                    @if($message->user_id !== $loginUser->id)
                        <div class="client_content">
                            <div>
                                <div class="user_detail">
                                    <div class="user_detail__img-name">
                                        <div class="circle">
                                            @if (!empty($profiles->user_img))
                                                <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="プロフ画像">
                                            @else
                                                <img src="../img/default_user_img.png" alt="">
                                            @endif
                                        </div>
                                        <div class="user_name">{{ $dealUser->user->name }}</div>
                                    </div>

                                    <div class="user_message">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($message->user_id === $loginUser->id)
                        <!-- 自分側 -->
                        <div class="user_content">
                            <div class="user_content__img-name">
                                <div class="user_name">{{ $loginUser->name }}</div>
                                <div class="circle">
                                    @if (!empty($loginUser->address->user_img))
                                        <img src="{{ asset('storage/' . $loginUser->address->user_img) }}" alt="プロフ画像">
                                    @else
                                        <img src="../img/default_user_img.png" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="user_content__user_message">
                                <div class="user_message ">
                                    <p>{{ $message->message }}</p>
                                </div>
                            </div>
                            <div class="edit_action">
                                <form action="/message_edit">
                                    @csrf
                                    編集
                                </form>
                                <form action="/message_delete">
                                    @csrf
                                    削除
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- メッセージ入力・送信欄 -->
            <div class="previewImage">
                <img id="previewImage">
            </div>
            <div class="send_message">
                <form action="/send/message" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $loginUser->id }}">
                    <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                    <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                    <textarea class ="message-box" name="message"  placeholder="  取引メッセージを記入してください"></textarea>
                    <div class="item-detail__img-box">
                        <input id="imageUploader"  class="img_select-button" type="file" accept="image/*" name="item_img" value="">
                    </div>
                    @error('item_img')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <script src="{{ asset('js/profile_image.js') }}"></script>
                    <div class="send-btm__group">
                        <button class="send-btm__button">
                            <div class="send-btm__img">
                            <img src="{{ asset('../../img/send_button.jpg') }}" alt="送信ボタン">
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            @elseif($firstPart !== $loginUser->id)<!--購入者へメッセージ-->
            <div class="chat_content">
                <!-- メッセージ相手 -->
                @foreach($messages as $message)
                    @if($message->user_id !== $loginUser->id)
                        <div class="client_content">
                            <div>
                                <div class="user_detail">
                                    <div class="user_detail__img-name">
                                        <div class="circle">
                                            @if (!empty($dealUser->address->user_img))
                                                <img src="{{ asset('storage/' . $dealUser->address->user_img) }}" alt="プロフ画像">
                                            @else
                                                <img src="../img/default_user_img.png" alt="">
                                            @endif
                                        </div>
                                        <div class="user_name">{{ $dealUser->name }}</div>
                                    </div>

                                    <div class="user_message">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($message->user_id === $loginUser->id)
                        <!-- 自分側 -->
                        <div class="user_content">
                            <div class="user_content__img-name">
                                <div class="user_name">{{ $loginUser->name }}</div>
                                <div class="circle">
                                    @if (!empty($loginUser->address->user_img))
                                        <img src="{{ asset('storage/' . $loginUser->address->user_img) }}" alt="プロフ画像">
                                    @else
                                        <img src="../img/default_user_img.png" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="user_content__user_message">
                                <div class="user_message ">
                                    <p>{{ $message->message }}</p>
                                </div>
                            </div>
                            <div class="edit_action">
                                <form action="/message_edit">
                                    @csrf
                                    編集
                                </form>
                                <form action="/message_delete">
                                    @csrf
                                    削除
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- メッセージ入力・送信欄 -->
            <div class="previewImage">
                <img id="previewImage">
            </div>
            <div class="send_message">
                <form action="/send/message" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $loginUser->id }}">
                    <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                    <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                    <textarea class ="message-box" name="message"  placeholder="  取引メッセージを記入してください"></textarea>
                    <div class="item-detail__img-box">
                        <input id="imageUploader"  class="img_select-button" type="file" accept="image/*" name="item_img" value="">
                    </div>
                    @error('item_img')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <script src="{{ asset('js/profile_image.js') }}"></script>
                    <div class="send-btm__group">
                        <button class="send-btm__button">
                            <div class="send-btm__img">
                            <img src="{{ asset('../../img/send_button.jpg') }}" alt="送信ボタン">
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        @endif
        </main>
    </div>
</body>