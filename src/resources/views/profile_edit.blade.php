<!-- 会員登録後に遷移してくる画面 住所の入力(初回) -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}" />
@endsection

@section('content')

    <div class="profile_edit-form__content">
        <div class="profile_edit-form__heading">
            <h2>プロフィール設定</h2>
        </div>

        <div class="profile_edit-form__input">
        @if(isset($profiles))
            <form class="form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
            @method('PATCH')
        @else
            <form class="form" action="/" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <!-- プロフ画像 -->
                <div class="form__group-content-img">
                    <div class="circle">
                    @if(isset($profiles))
                        <img src="{{ asset('storage/' . $profiles->user_img) }}" alt="画像">
                    @else
                        <img src="../img/default_user_img.png" alt="">
                    @endif
                    </div>
                    @if(isset($profiles))
                        <input type="hidden" name="id" value="{{ $profiles->id }}" />
                    @endif
                    @if(isset($profiles))
                        <input type="file" class="img_select-button" name="user_img" value="{{ asset('storage/' . $profiles->user_img) }}"accept="image/*" />
                    @else
                        <input type="file" class="img_select-button" name="user_img" accept="image/*" />
                    @endif
                </div>
            @error('user_img')
                {{ $message }}
            @enderror
        </div>
            <!-- ユーザー名 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">ユーザー名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <input type="text" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <!-- 郵便番号 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">郵便番号</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                    @if(isset($profiles))
                        <input type="text" name="post_code" value="{{ $profiles->post_code }}"/>
                    @else
                        <input type="text" name="post_code" value=""/>
                    @endif
                    </div>
                    <div class="form__error">
                        @error('post_code')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <!-- 住所 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                    @if(isset($profiles))
                        <input type="text" name="address" value="{{ $profiles->address }}"/>
                    @else
                        <input type="text" name="address" value=""/>
                    @endif
                    </div>
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <!-- 建物名 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                    @if(isset($profiles))
                        <input type="text" name="building" value="{{ $profiles->building }}" />
                    @else
                        <input type="text" name="building" value="" />
                    @endif
                    </div>
                </div>
            </div>

            <!-- 更新するをクリックすると商品一覧画面に遷移 -->
            <div class="form__button">
                <button class="form__button-submit" type="submit">更新する</button>
            </div>
        </form>
    </div>
    </div>

@endsection


