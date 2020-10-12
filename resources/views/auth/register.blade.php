@extends('layouts.base')

@section('title', 'Daftar Akun')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userAuthentication.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="userAuthentication">
    <div class="userAuthentication__container">
        <h4 class="userAuthentication__title">Daftar akun baru sekarang</h4>
        <img src="/img/auth-image.svg" alt="register-image"/>
        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input placeholder="Masukkan nama Anda di sini" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" value="{{ old('name') }}" name="name" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input placeholder="Masukkan password di sini" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" name="email" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input placeholder="Masukkan password di sini" id="password" type="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="passwordHelp" name="password" required autocomplete="new-password">
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
                <small id="passwordHelp" class="form-text text-muted">Password minimal memiliki 8 huruf, satu huruf besar, satu huruf kecil, dan satu angka.</small>
            </div>
            <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <div class="input-group">
                    <input placeholder="Masukkan konfirmasi password di sini" id="password-confirm" type="password" class="form-control" aria-describedby="confirmationPasswordHelp" name="password_confirmation" required autocomplete="new-password">
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
            <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/userRegisterPage.js') }}"></script>
@endsection
