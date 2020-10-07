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
            <form class="auth-form" method="POST" action="{{ route('register.customer.project.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="register-project">Nama Proyek</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="register-project" aria-describedby="projectHelp" required autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="register-order">Kategori</label>
                    <select class="form-control" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="register-order">Jumlah Pesanan</label>
                    <input name="count" type="number" class="form-control @error('count') is-invalid @enderror" value="{{ old('count') }}" id="register-order" aria-describedby="orderHelp" required>
                    @error('count')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="register-address">Alamat</label>
                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="register-address" aria-describedby="addressHelp" required autocomplete="address">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="register-note">Catatan</label>
                    <textarea name="note" type="text" class="form-control" id="register-note" aria-describedby="noteHelp" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="register-picture">Upload Gambar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="register-picture" class="input-group-text" id="pictureAddon">Browse</label>
                        </div>
                        <div class="input-files">
                            <input name="project_pict_path[]" id="register-picture" type="file" class="form-control @error('project_pict_path') is-invalid @enderror" value="{{ old('project_pict_path') }}" aria-describedby="pictureAddon" multiple>
                        </div>
                        @error('project_pict_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
