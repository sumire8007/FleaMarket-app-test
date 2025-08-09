<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleaMarket</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}"/>
    <script src="https://kit.fontawesome.com/d872711579.js" crossorigin="anonymous"></script>

</head>
<body>
    <header class="logo">
        <img src="{{ asset('../../img/logo.png') }}" alt="coachtech">
    </header>
    <div class="content">
        <aside>
            <div class="side">
                その他の取引
            </div>
        </aside>
        <main>
            <!-- チャットのタイトル　取引相手の名 と　取引相手のプロフ画像-->
            <div class="deal_user">
                <div class="circle">
                    @if (!empty($profiles->user_img))
                        <img src="{{ asset('storage/' . $profiles[$comment->user_id]->user_img) }}" alt="プロフ画像">
                    @else
                        <img src="../img/default_user_img.png" alt="">
                    @endif
                </div>
                <div class="title_content">
                    <div class="title">
                        「ユーザー名」さんとの取引画面
                    </div>
                    <form action="">
                        @csrf
                        <button class="completed_btm">取引を完了する</button>
                    </form>
                </div>
            </div>
            <!-- 商品の詳細 -->
            <div class="item_content">
                <div class="item_img"><img src="" alt="商品画像"></div>
                <div class="item_detail">
                    <div>
                    <div class="item_name">商品名</div>
                    <div class="item_price">商品価格</div>

                    </div>
                </div>
            </div>
    <!-- ここでウィンドウ固定を入れる -->
            <!-- メッセージの画面 -->
            <div class="chat_content">
                <!-- メッセージ相手 -->
                <div class="client_content">
                    <div class="user_detail">
                        <div class="circle">
                            @if (!empty($profiles->user_img))
                                <img src="{{ asset('storage/' . $profiles[$comment->user_id]->user_img) }}" alt="プロフ画像">
                            @else
                                <img src="../img/default_user_img.png" alt="">
                            @endif
                        </div>
                        <div class="user_name">ユーザー名</div>
                    </div>
                    <div class="user_message">
                        <p>ここにメッセージ入る</p>
                    </div>
                </div>
                <!-- 自分側 -->
                <div class="user_content">
                    <div class="circle">
                        @if (!empty($profiles->user_img))
                            <img src="{{ asset('storage/' . $profiles[$comment->user_id]->user_img) }}" alt="プロフ画像">
                        @else
                            <img src="../img/default_user_img.png" alt="">
                        @endif
                    </div>
                    <div class="user_name">ユーザー名</div>
                    <div class="user_message">
                        <p>ここにメッセージが入る</p>
                    </div>
                    <div class="edit_action">
                    <form action="/message_edit">編集</form>
                    <form action="/message_delete">削除</form>

                    </div>
                </div>
            </div>
                <div class="previewImage">
                    <img id="previewImage">
                </div>
            <!-- メッセージ入力・送信欄 -->
            <div class="send_message">
                <form action="/send_message" method="post">
                    @csrf
                    <textarea class ="message-box" name="keyword" value="{{ session('keyword') }}" placeholder="  取引メッセージを記入してください"></textarea>
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
        </main>
    </div>
</body>