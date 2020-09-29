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
                <div class="steps__step done">
                    <div class="steps__number">✔
                    </div>
                    <p class="steps__description">Daftar Akun</p>
                </div>
                <div class="steps__step active">
                    <div class="steps__number">2
                    </div>
                    <p class="steps__description">Tambah Proyek</p>
                </div>
            </div>
            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label for="register-project">Nama Proyek</label>
                    <input type="text" class="form-control" id="register-project" aria-describedby="projectHelp">
                </div>
                <div class="form-group">
                    <label for="register-order">Jumlah Pesanan</label>
                    <select class="form-control">
                        <option value="">Pilih opsi</option>
                        <option value="Seragam Putih">Seragam Putih</option>
                        <option value="Seragam Kantoran">Seragam Kantoran</option>
                        <option value="Seragam TNI">Seragam TNI</option>
                        <option value="Seragam Pilot">Seragam Pilot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="register-order">Jumlah Pesanan</label>
                    <input type="text" class="form-control" id="register-order" aria-describedby="orderHelp">
                </div>
                <div class="form-group">
                    <label for="register-address">Alamat</label>
                    <input type="text" class="form-control" id="register-address" aria-describedby="addressHelp">
                </div>
                <div class="form-group">
                    <label for="register-note">Catatan</label>
                    <textarea type="text" class="form-control" id="register-note" aria-describedby="noteHelp" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="register-picture">Upload Gambar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-picture" class="input-group-text" id="pictureAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <input id="register-picture" type="file" class="form-control" aria-describedby="pictureAddon">
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
@endsection
