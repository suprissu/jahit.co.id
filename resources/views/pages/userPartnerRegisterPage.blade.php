@extends('layouts.base')

@section('title', 'Daftar Mitra')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userRegistration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="userRegistration">
    <div class="userRegistration__container">
        <div class="userRegistration__header">
            <h1 class="userRegistration__title">Hi, Mitra Jahit.co.id!</h1>
            <img class="userRegistration__hero" src="/img/partner-image.png" alt="hero-image" />
        </div>
        <div class="userRegistration__register">
            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label for="register-name">Nama Lengkap</label>
                    <input placeholder="Masukkan nama anda di sini" type="text" class="form-control" id="register-name" aria-describedby="nameHelp">
                </div>
                <div class="form-group">
                    <label for="register-vendor">Nama Konveksi</label>
                    <input placeholder="Masukkan nama vendor anda di sini" type="text" class="form-control" id="register-vendor" aria-describedby="vendorHelp">
                </div>
                <div class="form-group">
                    <label for="register-phone">Nomor Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="phoneAddon">+62</span>
                        </div>
                        <input placeholder="853423xxxx" id="register-phone" type="text" class="form-control" aria-describedby="phoneAddon">
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-address">Alamat</label>
                    <input placeholder="Masukkan alamat vendor anda di sini" type="text" class="form-control" id="register-address" aria-describedby="addressHelp">
                </div>
                <div class="form-group">
                    <label for="register-ktp">Upload KTP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-ktp" class="input-group-text" id="ktpAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <p class="input-files-filename"></p>
                            <input placeholder="ktp_ahmadsupriyanto.jpg" id="register-ktp" type="file" class="form-control" aria-describedby="ktpAddon">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-npwp">Upload NPWP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-npwp" class="input-group-text" id="npwpAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <p class="input-files-filename"></p>
                            <input placeholder="npwp_cahayaabadi.pdf" id="register-npwp" type="file" class="form-control" aria-describedby="npwpAddon">
                        </div>
                    </div>
                </div>
                <button type="submit" class="userRegistration__submit btn btn-danger">Selanjutnya</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/form.js') }}"></script>
@endsection
