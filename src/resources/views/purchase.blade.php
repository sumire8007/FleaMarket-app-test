@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<div class="purchase__content-group">
    <div class="purchase__content-detail">
        <div class="purchase__content">
            <div class="item-detail__img">
                <img src="" alt="商品画像">
            </div>
            <div class="item-detail__basic">
                <h2>商品名</h2>
                <p>¥47,000(税込)</p>
            </div>
        </div>
        <div class="purchase__content-payment">
            <p>支払い方法</p>
            <select name="payment_content" id="">
                <option value="">選択してください</option>
                <option value="">コンビニ払い</option>
                <option value="">カード払い</option>
            </select>
        </div>
        <div class="purchase__content-address-box">
            <div class="purchase__content-address-title">
                <p>配送先</p>
                <a href="/purchase/address">変更する</a>
            </div>
            <div class="purchase__content-address">
                <p>〒XXX-YYYY</p>
                <p>ここには住所と建物が入ります</p>
            </div>
        </div>
    </div>

    <div class="purchase_total">
        <table>
            <tr>
                <th>商品代金</th>
                <td>¥47,000</td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td>コンビニ払い</td>
            </tr>
        </table>
        <form action="" name="" value="">
            <button class="buy_button">購入手続きへ</button>
        </form>
    </div>
</div>

@endsection