@extends('layouts.base')

@section('title', 'Masuk Akun')

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
        <h4 class="userAuthentication__title">Masuk ke dalam akun untuk melanjutkan</h4>
        <img src="/img/auth-image.svg" alt="login-image"/>
        <form class="auth-form" method="POST" action="">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input placeholder="Masukkan email di sini" type="email" class="form-control" id="login-email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <div class="input-group">
                    <input placeholder="Masukkan password di sini" id="login-password" type="password" class="form-control"  aria-describedby="passwordHelp">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="passwordHelp">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="submit" class="userAuthentication__submit btn btn-danger">Masuk</button>
        </form>
        <div class="userAuthentication__switch">
            <p>Belum punya akun ?</p>
            <a href="/user/register">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/userLoginPage.js') }}"></script>
@endsection
