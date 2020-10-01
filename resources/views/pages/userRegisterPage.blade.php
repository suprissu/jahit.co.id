@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userAuthentication.css') }}">
@endsection

@section('content')
<div class="userAuthentication">
    <div class="userAuthentication__container">
        <h4 class="userAuthentication__title">Daftar akun baru sekarang</h4>
        <img src="/img/auth-image.svg" alt="register-image"/>
        <form class="auth-form" method="POST" action="">
            <div class="form-group">
                <label for="register-email">Email</label>
                <input placeholder="Masukkan email di sini" type="email" class="form-control" id="register-email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="register-password">Password</label>
                <div class="input-group">
                    <input placeholder="Masukkan password di sini" id="register-password" type="password" class="form-control"  aria-describedby="registerPasswordHelp">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="passwordHelp">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <small id="registerPasswordHelp" class="form-text text-muted">Password minimal memiliki 8 huruf, satu huruf besar, satu huruf kecil, dan satu angka.</small>
            </div>
            <div class="form-group">
                <label for="register-confirmation-password">Konfirmasi Password</label>
                <div class="input-group">
                    <input placeholder="Masukkan konfirmasi password di sini" id="register-confirmation-password" type="password" class="form-control"  aria-describedby="confirmationPasswordHelp">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="confirmationPasswordHelp">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="submit" class="userAuthentication__submit btn btn-danger">Selanjutnya</button>
        </form>
        <div class="userAuthentication__switch">
            <p>Sudah punya akun ?</p>
            <a href="/user/login">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/userRegisterPage.js') }}"></script>
@endsection
