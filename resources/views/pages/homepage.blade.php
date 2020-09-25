@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partnerInvitation.css') }}">
@endsection

@section('content')
    @include('layouts/home/hero')
    @include('layouts/home/about')
    @include('layouts/home/timeline')
    @include('layouts/home/products')
    @include('layouts/home/partnerInvitation')
@endsection

@section('extra-js')
    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="{{ asset('js/home/timeline.js') }}"></script>
    <script src="{{ asset('js/home/products.js') }}"></script>
@endsection
