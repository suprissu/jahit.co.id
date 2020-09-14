@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="welcome-message">
        <h1>
            Welcome to jahit.co.id!
        </h1>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endsection
