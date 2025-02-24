@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__content-group">
    <div class="purchase__content-detail">
        <div class="purchase__content">
            <div class="item-detail__img">
                <img src="{{ $item->item_img }}" alt="商品画像">
            </div>
            <div class="item-detail__basic">
                <h2>{{ $item->item_name }}</h2>
                <p>¥{{ $item->price }}(税込)</p>
            </div>
        </div>
        <div class="purchase__content-payment">
            <p>支払い方法</p>
                <select name="payment_content" wire:model="selectedValue">
                    <option>選択してください</option>
                    @foreach($payments as $payment)
                    <option name="content" value="{{ $payment->content }}">
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
        <!-- @csrf -->
            <button  class="buy_button">購入する</button>
        <!-- </form> -->
    </div>
</div>

@endsection