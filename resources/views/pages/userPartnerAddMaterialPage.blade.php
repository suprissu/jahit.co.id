@extends('layouts.base')

@section('title', 'Daftar Mitra')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userPartnerAddMaterial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="userPartnerAddMaterial">
    <div class="userPartnerAddMaterial__container">
        <div class="userPartnerAddMaterial__header">
            <div class="userPartnerAddMaterial__wrapper">
                <h3 class="userPartnerAddMaterial__title">Minta Bahan ke Jahit.co.id</h3>
                <img src="/img/partner-image.png" alt="hero-image" />
            </div>
        </div>
        <div class="userPartnerAddMaterial__addMaterial">
            <form class="auth-form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="project-name">Nama Proyek</label>
                    <select class="form-control" name="project-name" id="project-name" required>
                        <option value="1">Rompi Relawan Covid 1</option>
                        <option value="2">Rompi Relawan Covid 2</option>
                        <option value="3">Rompi Relawan Covid 3</option>
                    </select>
                    @error('project-name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="project-material">Bahan-bahan yang dibutuhkan</label>
                    <select class="form-control" name="project-material" id="project-material" required>
                        <option value="1">Spanduk 1</option>
                        <option value="2">Spanduk 2</option>
                        <option value="3">Spanduk 3</option>
                    </select>
                    @error('project-material')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="material-amount">Jumlah material</label>
                    <input placeholder="Masukkan jumlah material yang dibutuhkan" name="material_amount" type="text" class="form-control @error('material_amount') is-invalid @enderror" value="{{ old('material_amount') }}" id="material-amount" aria-describedby="materialHelp" required autocomplete="material_amount" autofocus>            
                    @error('material_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="material-note">Catatan</label>
                    <textarea name="note" type="text" class="form-control" id="material-note" aria-describedby="noteHelp" rows="3"></textarea>
                </div>
                <button type="submit" class="userPartnerAddMaterial__submit btn btn-danger">Selanjutnya</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/form.js') }}"></script>
@endsection
