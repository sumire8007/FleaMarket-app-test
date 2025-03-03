@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form action="/purchase" method="post">
@csrf
    <div class="purchase__content-group">
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="address_id" value="{{ $profiles->id }}">
        <div class="purchase__content-detail">
            <div class="purchase__content">
                <div class="item-detail__img">
                    <img src="{{ $item->item_img }}" alt="商品画像">
                </div>
                <div class="item-detail__basic">
                    <h2>{{ $item->item_name }}</h2>
                    <p>{{ $item->price }}(税込)</p>
                </div>
            </div>
            <div class="purchase__content-payment">
                <p>支払い方法</p>
                    <select name="payment_id" wire:model="selectedValue">
                        <option>選択してください</option>
                        @foreach($payments as $payment)
                        <option name="payment_id" value="{{ $payment->id }}">
                            {{ $payment->content }}
                        </option>
                        @endforeach
                    </select>
            </div>
            <div class="purchase__content-address-box">
                <div class="purchase__content-address-title">
                    <p>配送先</p>
                    <a href="/purchase/address">変更する</a>
                </div>
                <div class="purchase__content-address">
                    <p>〒{{ $profiles->post_code }}</p>
                    <p>{{ $profiles->address }}</p>
                    <p>{{ $profiles->building }}</p>
                </div>
            </div>
        </div>
        <div class="purchase_total">
            <table>
                <tr>
                    <th>商品代金</th>
                    <td>{{ $item->price }}</td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td><livewire:counter></td>
                </tr>
            </table>
            <button type="submit" class="buy_button">購入する</button>
        </div>
    </div>
</form>
@endsection