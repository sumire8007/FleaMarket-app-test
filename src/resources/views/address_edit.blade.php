<!-- 配送先の住所変更 -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address_edit.css') }}" />
@endsection

@section('content')
    <div class="address_edit-form__content">
        <div class="profile_edit-form__heading">
            <h2>住所の変更</h2>
        </div>
            <form class="form" action="/purchase/address" method="post">
                @method('PATCH')
                @csrf
                @if(!empty($profiles))
                    <div class="address_edit-form__input">
                        <input type="hidden" name="id" value="{{ $profiles->id }}">
                        <!-- 郵便番号 -->
                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">郵便番号</span>
                            </div>
                            <div class="form__group-content">
                                <div class="form__input--text">
                                    <input type="text" name="post_code" value="{{ $profiles->post_code }}"/>
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
                                    <input type="text" name="address" value="{{ $profiles->address }}"/>
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
                                    <input type="text" name="building" value="{{ $profiles->building }}" />
                                </div>
                            </div>
                        </div>
                        <!-- 更新するをクリックすると商品購入画面に遷移 -->
                        <div class="form__button">
                            <button class="form__button-submit" type="submit">更新する</button>
                        </div>
                    </div>
                @else
                    <div class="address_edit-form__input">
                        <input type="hidden" name="id" value="">
                        <!-- 郵便番号 -->
                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">郵便番号</span>
                            </div>
                            <div class="form__group-content">
                                <div class="form__input--text">
                                    <input type="text" name="post_code" value=""/>
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
                                    <input type="text" name="address" value=""/>
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
                                    <input type="text" name="building" value="" />
                                </div>
                            </div>
                        </div>
                        <!-- 更新するをクリックすると商品購入画面に遷移 -->
                        <div class="form__button">
                            <button class="form__button-submit" type="submit">更新する</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection