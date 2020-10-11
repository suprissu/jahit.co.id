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
            <div class="userRegistration__wrapper">
                <h1 class="userRegistration__title">Hi, Mitra Jahit.co.id!</h1>
                <img src="/img/partner-image.png" alt="hero-image" />
            </div>
        </div>
        <div class="userRegistration__register">
            <form class="auth-form" method="POST" action="{{ route('register.partner.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="register-vendor">Nama Konveksi</label>
                    <input placeholder="Masukkan nama konveksi Anda di sini" name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" id="register-vendor" aria-describedby="vendorHelp" required autocomplete="company_name" autofocus>
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
                        <input placeholder="853423xxxx" name="phone_number" id="register-phone" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" aria-describedby="phoneAddon" required autocomplete="phone_number">
                    </div>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="register-address">Alamat</label>
                    <input placeholder="Masukkan alamat vendor anda di sini" name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="register-address" aria-describedby="addressHelp" required autocomplete="address">
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="register-ktp">Upload KTP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-ktp" class="input-group-text" id="ktpAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <p class="input-files-filename">{{ old('ktp_pict_link') }}</p>
                            <input placeholder="ktp_ahmadsupriyanto.jpg" name="ktp_pict_link" id="register-ktp" type="file" class="form-control @error('ktp_pict_link') is-invalid @enderror" value="{{ old('ktp_pict_link') }}" aria-describedby="ktpAddon" required multiple>
                        </div>
                    </div>
                    @error('ktp_pict_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="register-npwp">Upload NPWP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-npwp" class="input-group-text" id="npwpAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <p class="input-files-filename">{{ old('npwp_pict_link') }}</p>
                            <input placeholder="npwp_cahayaabadi.pdf" name="npwp_pict_link" id="register-npwp" type="file" class="form-control @error('npwp_pict_link') is-invalid @enderror" value="{{ old('npwp_pict_link') }}" aria-describedby="npwpAddon" required multiple>
                        </div>
                    </div>
                    @error('npwp_pict_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
