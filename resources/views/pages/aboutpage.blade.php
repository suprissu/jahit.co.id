@extends('layouts.base')

@section('title', 'Tentang Kami')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/hero.css') }}">
@endsection

@section('content')
<div class="aboutpage">
    <div class="hero-header">
        <div class="hero-header__bg">
            <div class="hero-header__container">
                <h1 class="hero-header__title">Tentang kami</h1>
            </div>
        </div>
    </div>
    <div class="aboutpage__container">
        <div class="aboutpage__description">
            <p>JAHIT.CO.ID lahir pada bulan Maret 2020 , Pada saat Wabah COVID-19 Merebak di Indonesia dan Seluruh Dunia. Pemerintah melakukan lockdown dan seluruh aktivitas ekonomi harus dilakukan dari rumah. Banyak rantai ekonomi tradisional yang terputus dan salah satunya adalah industri textile khususnya para UMKM Konveksi yang masih sangat tradisional.

Berbekal pengalaman di Industri Textile sejak tahun 1990 an, Semangat kami untuk membantu para pelaku UMKM dibidang jahit atau konveksi untuk mendapatkan customer lebih luas dan lebih cepat di sisi lain Customer akan mendapatkan vendor jahit dengan kualitas  terpercaya dengan harga yang lebih terjangkau.

2 Jenis Bantuan yang kami berikan kepada Partner Jahit atau Konveksi kami :

Bantuan Pemasaran : Kami membantu partner kami untuk mendapatkan project jahit langsung dari pemilik project tanpa perantara sehingga Vendor jahit mendapat keuntungan lebih besar dengan budget yang ditentukan. 
Bantuan Modal Kerja : Kami membantu partner kami untuk mendapatkan dukungan modal kerja dengan project yang sedang dijalankan, tentunya dengan verifikasi dan pengawasan yang ketat dari tim Jahit.co.id.</p>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
