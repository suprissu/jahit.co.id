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
@endsection

@section('content')
    @include('layouts/home/hero')
    @include('layouts/home/about')
    @include('layouts/home/timeline')
@endsection

@section('extra-js')
    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="{{ asset('js/home/timeline.js') }}"></script>
@endsection
