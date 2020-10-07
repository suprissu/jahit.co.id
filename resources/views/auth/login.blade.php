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
        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" aria-describedby="emailHelp" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input id="password" type="password" aria-describedby="passwordHelp" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="passwordHelp">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="userAuthentication__submit btn btn-danger">Masuk</button>
        </form>
        <div class="userAuthentication__switch">
            <p>Belum punya akun ?</p>
            <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/userLoginPage.js') }}"></script>
@endsection
