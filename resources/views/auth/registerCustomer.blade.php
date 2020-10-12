@extends('layouts.base')

@section('title', 'Daftar Customer')

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
            <div class="userRegistration__wrapper">
                <h3 class="userRegistration__title">Hi, Pelanggan Jahit.co.id!</h3>
                <p class="userRegistration__description">Silahkan lengkapi tabel di bawah ini untuk disebar ke
                    <strong>puluhan partner jahit kami</strong> dan temuan vendor terbaik anda!</p>
                <img src="/img/partner-image.png" alt="hero-image" />
            </div>
        </div>
        <div class="userRegistration__register">
            <div class="userRegistration__wrapper">
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
                <form class="auth-form" method="POST" action="{{ route('register.customer.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="register-company">Perusahaan</label>
                        <input placeholder="Masukkan nama perusahaan anda" name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" id="register-company" aria-describedby="companyHelp" required autocomplete="company_name" autofocus>            
                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="register-phone">Nomor Telepon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="phoneAddon">+62</span>
                            </div>
                            <input placeholder="852634xxxx" name="phone_number" id="register-phone" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" aria-describedby="phoneAddon" required autocomplete="phone_number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="userRegistration__submit btn btn-danger">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
