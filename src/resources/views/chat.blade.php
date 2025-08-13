<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <!-- チャットのタイトル　取引相手の名と取引相手のプロフ画像-->
            <div class="deal_user">
                @if($firstPart == $loginUser->id) <!--出品者へメッセージタイトル-->
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
                            @if(isset($rating))
                                <div class="no-active-modal">取引完了済み</div>
                            @else
                                <button id="openModal" class="open-modal">取引を完了する</button>
                            @endif
                    </div>
                    <!-- 取引完了モーダルの内容 -->
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span id="closeModal">&times;</span>
                            <div class="modal-title">
                                <p>取引が完了しました。</p>
                            </div>
                            <div class="rating-star">
                                <form id="ratingForm" action="{{ route('rating.store') }}" method="POST">
                                    @csrf
                                        <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                        <input type="hidden" name="to_user_id" value="{{ $dealUser->user->id }}">
                                        <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                                        <p>今回の取引相手はどうでしたか？</p>
                                        <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="star" data-value="{{ $i }}">★</span>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="stars" id="stars">
                                        <div class="rating-star__button">
                                            <button type="submit">送信する</button>
                                        </div>
                                </form>
                                <style>
                                    .star {
                                        cursor: pointer;
                                        color: lightgray;
                                    }
                                    .star.selected {
                                        color: gold;
                                    }
                                </style>
                                <script>
                                    document.querySelectorAll('.star').forEach(star => {
                                        star.addEventListener('click', function () {
                                            const value = this.getAttribute('data-value');
                                            document.getElementById('stars').value = value;
                                            document.querySelectorAll('.star').forEach(s => {
                                                s.classList.toggle('selected', s.getAttribute('data-value') <= value);
                                            });
                                        });
                                    });
                                    document.getElementById('ratingForm').addEventListener('submit', function (e) {
                                            const stars = document.getElementById('stars').value;
                                            if (!stars || stars < 1) {
                                                e.preventDefault();
                                                alert('星1つ以上で評価してください');
                                            }
                                        });
                                </script>
                            </div>
                        </div>
                    </div>
                    <script src="{{ asset('js/modal.js') }}"></script>

                @elseif($firstPart !== $loginUser->id)<!--購入者へメッセージタイトル-->
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
                    </div>

                    <!-- 取引完了モーダルの内容 (購入者の評価が済んでいる　&&　購入者へ評価がまだの時)-->
                    @php
    $buyersRating = App\Models\Rating::where('item_id', $dealItem->id)
        ->where('from_user_id', $dealUser->id)
        ->first();
    $sellerRating = App\Models\Rating::where('item_id', $dealItem->id)
        ->where('from_user_id', $loginUser->id)
        ->first();
                    @endphp
                    @if(isset($buyersRating) && empty($sellerRating))
                    <div id="myModal" class="modal-open">
                        <div class="modal-content">
                            <span id="closeModal">&times;</span>
                            <div class="modal-title">
                                <p>取引が完了しました。</p>
                            </div>
                            <div class="rating-star">
                                <form action="{{ route('rating.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                    <input type="hidden" name="to_user_id" value="{{ $dealUser->id }}">
                                    <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                                    <p>今回の取引相手はどうでしたか？</p>
                                    <div class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">★</span>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="stars" id="stars">
                                    <div class="rating-star__button">
                                        <button type="submit">送信する</button>
                                    </div>
                                </form>
                                <style>
                                    .star {
                                        cursor: pointer;
                                        color: lightgray;
                                    }

                                    .star.selected {
                                        color: gold;
                                    }
                                </style>
                                <script>
                                    document.querySelectorAll('.star').forEach(star => {
                                        star.addEventListener('click', function () {
                                            const value = this.getAttribute('data-value');
                                            document.getElementById('stars').value = value;
                                            document.querySelectorAll('.star').forEach(s => {
                                                s.classList.toggle('selected', s.getAttribute('data-value') <= value);
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
            </div>

            <!-- 商品の詳細 （共通部分）-->
            <div id="itemContent" class="item_content">
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
            <!-- メッセージの画面 -->
            @if($firstPart == $loginUser->id) <!--購入者から出品者へメッセージ-->
                <div class="chat_content">
                    <!-- メッセージ相手 -->
                    @foreach($messages as $message)
                        @if($message->user_id !== $loginUser->id) <!--相手（出品者のメッセージ）-->
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
                                            <div class="client_img">
                                                <img src="{{ asset('storage/' . $message->chat_img) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($message->user_id === $loginUser->id)<!-- 自分側（購入者のメッセージ） -->
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
                                    <div data-message-id="{{ $message->id }}" class="user_content__user_message">
                                        <div class="user_message ">
                                            <p class="message-text">{{ $message->message }}</p>
                                        </div>
                                        <div class="user_img">
                                            <img src="{{ asset('storage/' . $message->chat_img) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="edit_action">
                                        <button type="submit" id="openEditModal" class="edit-btn">編集</button>
                                        <button type="submit" id="openDeleteModal" class="delete-btn">削除</button>
                                    </div>
                                </div>
                                <!-- 編集モーダルの内容 -->
                                <div id="myEditModal" class="modal">
                                    <div class="modal-content">
                                        <span id="closeEditModal">&times;</span>
                                        <div class="modal-title">
                                            <p>メッセージの編集</p>
                                        </div>
                                        <div class="edit-message">
                                            <form id="editForm" action="{{ route('message.edit') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <div class="edit-message__textbox">
                                                    <textarea name="message" value="">{{ $message->message }}</textarea>
                                                </div>
                                                <div class="edit-message__button">
                                                    <button type="submit">保存</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- 削除モーダルの内容 -->
                                <div id="myDeleteModal" class="modal">
                                    <div class="modal-content">
                                        <span id="closeDeleteModal">&times;</span>
                                        <div class="modal-title">
                                            <p>このメッセージを削除してもよろしいですか？</p>
                                        </div>
                                        <div class="delete-message">
                                            <form id="deleteForm" action="{{ route('message.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <div class="delete-message__textbox">
                                                    <textarea>{{ $message->message }}</textarea>
                                                </div>
                                                <div class="delete-message__button">
                                                    <button type="submit">削除</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script src="{{ asset('js/chat.js') }}"></script>

                            @endif
                    @endforeach
                </div>
                <!-- メッセージ入力・送信欄 -->
                <div class="previewImage">
                    <img id="previewImage">
                </div>
                <div class="send_message">
                        <div class="form__error">
                            @error('message')
                                {{ $message }}
                            @enderror
                            <br />
                            @error('item_img')
                                {{ $message }}
                            @enderror
                        </div>
                    <form action="/send/message" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $loginUser->id }}">
                        <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                        <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">

                        <textarea class ="message-box" name="message"  placeholder="  取引メッセージを記入してください" data-item-id="{{ $dealItem->id }}"></textarea>
                        <script src="/js/chatDraft.js"></script>

                        <div class="chat__img-box">
                            <input id="imageUploader"  class="img_select-button" type="file" accept="image/*" name="chat_img" value="">
                        </div>
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
            @elseif($firstPart !== $loginUser->id)<!--出品者から購入者へメッセージ-->
                <div class="chat_content">
                    <!-- メッセージ相手 -->
                    @foreach($messages as $message)
                        @if($message->user_id !== $loginUser->id)<!--相手（購入者のメッセージ）-->
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
                                        <div class="client_img">
                                            <img src="{{ asset('storage/' . $message->chat_img) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($message->user_id === $loginUser->id)<!--相手（出品者のメッセージ）-->
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
                                        <div class="user_img">
                                            <img src="{{ asset('storage/' . $message->chat_img) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="edit_action">
                                        <button id="openEditModal" type="submit">編集</button>
                                        <button id="openDeleteModal" type="submit">削除</button>
                                    </div>
                                </div>
                                <!-- 編集モーダルの内容 -->
                                <div id="myEditModal" class="modal">
                                    <div class="modal-content">
                                        <span id="closeEditModal">&times;</span>
                                        <div class="modal-title">
                                            <p>メッセージの編集</p>
                                        </div>
                                        <div class="edit-message">
                                            <form id="editForm" action="{{ route('message.edit') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <div class="edit-message__textbox">
                                                    <textarea name="message" value="">{{ $message->message }}</textarea>
                                                </div>
                                                <div class="edit-message__button">
                                                    <button type="submit">保存</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- 削除モーダルの内容 -->
                            <div id="myDeleteModal" class="modal">
                                <div class="modal-content">
                                    <span id="closeDeleteModal">&times;</span>
                                    <div class="modal-title">
                                        <p>このメッセージを削除してもよろしいですか？</p>
                                    </div>
                                    <div class="delete-message">
                                        <form id="deleteForm" action="{{ route('message.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">
                                            <input type="hidden" name="id" value="{{ $message->id }}">
                                            <div class="delete-message__textbox">
                                                <textarea>{{ $message->message }}</textarea>
                                            </div>
                                            <div class="delete-message__button">
                                                <button type="submit">削除</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script src="{{ asset('js/chat.js') }}"></script>
                        @endif
                    @endforeach
                </div>
                <!-- メッセージ入力・送信欄 -->
                <div class="previewImage">
                    <img id="previewImage" class="preview">
                </div>

                <div class="send_message">
                    <div class="form__error">
                        @error('message')
                            {{ $message }}
                        @enderror
                        <br />
                        @error('item_img')
                            {{ $message }}
                        @enderror
                    </div>
                    <form action="/send/message" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $loginUser->id }}">
                        <input type="hidden" name="item_id" value="{{ $dealItem->id }}">
                        <input type="hidden" name="chat_flag" value="{{ $chatFlag }}">

                        <textarea class ="message-box" name="message"  placeholder="  取引メッセージを記入してください" data-item-id="{{ $dealItem->id }}"></textarea>
                        <script src="/js/chatDraft.js"></script>

                        <div class="chat__img-box">
                            <input id="imageUploader" class="img_select-button" type="file" accept="image/*" name="chat_img" value="">
                        </div>
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