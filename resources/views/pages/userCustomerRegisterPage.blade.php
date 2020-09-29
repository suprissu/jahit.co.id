@extends('layouts.base')

@section('title', 'Daftar Mitra')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userRegistration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/steps.css') }}">
@endsection

@section('content')
<div class="userRegistration">
    <div class="userRegistration__container">
        <div class="userRegistration__header">
            <h1 class="userRegistration__title">Hi, Pelanggan Jahit.co.id!</h1>
            <img class="userRegistration__hero" src="/img/partner-image.png" alt="hero-image" />
        </div>
        <div class="userRegistration__register">
            <div class="steps">
                <div class="steps__step active">
                    <div class="steps__number">1
                    </div>
                    <p class="steps__description">Daftar Akun</p>
                </div>
                <div class="steps__step">
                    <div class="steps__number">2
                    </div>
                    <p class="steps__description">Tambah Proyek</p>
                </div>
            </div>
            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label for="register-name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="register-name" aria-describedby="nameHelp">
                </div>
                <div class="form-group">
                    <label for="register-company">Perusahaan</label>
                    <input type="text" class="form-control" id="register-company" aria-describedby="companyHelp">
                </div>
                <div class="form-group">
                    <label for="register-phone">Nomor Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="phoneAddon">+62</span>
                        </div>
                        <input id="register-phone" type="text" class="form-control" aria-describedby="phoneAddon">
                    </div>
                </div>
                <button type="submit" class="userRegistration__submit btn btn-danger">Selanjutnya</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
