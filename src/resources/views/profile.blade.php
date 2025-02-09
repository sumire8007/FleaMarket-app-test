<!-- マイページの詳細 -->
@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="">
    <h1>mypage</h1>
</div>
<form action="/mypage/profile" method="get">
    <button>プロフィールを編集</button>
</form>

@endsection