@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/partnerInvitation.css') }}">
@endsection

@section('content')
    @include('layouts/home/hero')
    @include('layouts/home/about')
    @include('layouts/home/timeline')
    @include('layouts/home/products')
    @include('layouts/home/partnerInvitation')
@endsection

@section('extra-js')
    <script src="{{ asset('js/home/timeline.js') }}"></script>
    <script src="{{ asset('js/home/products.js') }}"></script>
@endsection
