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
@endsection

@section('content')
    @include('layouts/home/hero')
    @include('layouts/home/about')
@endsection

@section('extra-js')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endsection
