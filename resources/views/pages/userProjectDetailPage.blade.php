@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userProjectDetail.css') }}">
@endsection

@section('content')
<div class="userProjectDetail">
    <div class="userProjectDetail__container">
        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                    <img src="{{ asset('img/hero-image.jpg') }}" class="d-block w-100" alt="project-preview">
                </div>
                <div class="carousel-item" data-interval="2000">
                    <img src="{{ asset('img/jeans.png') }}" class="d-block w-100" alt="project-preview">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/dummy-img.jpg') }}" class="d-block w-100" alt="project-preview">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="userProjectDetail__wrapper">
            <h2 class="userProjectDetail__title">Relawan Rompi COVID</h2>
        </div>
    </div>
</div>
@endsection

@section('extra-js')

@endsection
