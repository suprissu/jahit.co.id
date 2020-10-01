@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script>var data = [{
        
    }]</script>
    <script src="{{ asset('js/home/timeline.js') }}"></script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@endsection

@section('extra-js')
@endsection
