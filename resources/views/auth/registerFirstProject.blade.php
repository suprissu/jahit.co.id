@extends('layouts.base')

@section('title', 'Daftar Project Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userRegistration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
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
                        <input name="name" placeholder="Masukkan nama proyek di sini" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="register-project" aria-describedby="projectHelp" required autofocus>
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
                        <input name="count" placeholder="Masukkan jumlah pesanan di sini" type="number" class="form-control @error('count') is-invalid @enderror" value="{{ old('count') }}" id="register-order" aria-describedby="orderHelp" required>
                        @error('count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="register-address">Alamat</label>
                        <input name="address" placeholder="Masukkan alamat di sini" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="register-address" aria-describedby="addressHelp" required autocomplete="address">
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
                        <div class="upload-files__container">
                            <div class="upload-files__wrapper">
                                <input class="upload-files__input" name="project_pict_path[]" id="register-picture" type="file" class="form-control @error('project_pict_path.0') is-invalid @enderror" value="{{ old('project_pict_path.0') }}" aria-describedby="pictureAddon" multiple>
                                <label for="register-ktp" class="upload-files__add">Upload file</label>
                            </div>
                            <div class="upload-files__preview">
                            </div>
                        </div>
                        @error('project_pict_path.0')
                        <span class="invalid-feedback" role="alert">
                            Some files might have invalid format or more than 2,5MB.
                        </span>
                        @enderror
                        <small id="pictureAddon" class="form-text text-muted">Dapat pilih banyak gambar dengan menggunakan CTRL (PC) atau hold image satu per satu (HP)</small>
                    </div>
                    <button type="submit" class="userRegistration__submit btn btn-danger">Selanjutnya</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/form.js') }}"></script>
@endsection
