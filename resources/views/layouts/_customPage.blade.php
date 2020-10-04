@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
@endsection

@section('content')
<custom-page image="{{ asset('img/hero-image.jpg') }}" title="404 Not Found" message="Mau kemana ya ? Balik lagi yuk ?"></custom-page>
@endsection

@section('extra-js')
<script src="{{ asset('js/customPage.js') }}"></script>
@endsection
