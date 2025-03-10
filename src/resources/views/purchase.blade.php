@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
    <livewire:payment-method :id="request()->query('id')" />
@endsection