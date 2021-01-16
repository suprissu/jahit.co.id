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
            <form class="auth-form" method="POST" action="{{ route('home.transaction.material.request') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="projectID">Nama proyek</label>
                    <select class="form-control" name="projectID" id="projectID" required>
                        @foreach ( $projects as $project )
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('projectID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="materialID">Bahan-bahan yang dibutuhkan</label>
                    <select class="form-control" name="materialID" id="materialID" required>
                        @foreach ( $materials as $material )
                            <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->metric }})</option>
                        @endforeach
                    </select>
                    @error('materialID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="material-name">Nama bahan</label>
                    <input placeholder="Masukkan nama bahan jika memilih 'Lainnya'" name="additionalInfo" type="text" class="form-control @error('additionalInfo') is-invalid @enderror" value="{{ old('additionalInfo') }}" id="material-name" aria-describedby="materialHelp" autocomplete="additionalInfo" autofocus>            
                    @error('additionalInfo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="material-amount">Jumlah material</label>
                    <input placeholder="Masukkan jumlah material yang dibutuhkan" name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" id="material-amount" aria-describedby="materialHelp" required autocomplete="quantity" autofocus>            
                    @error('quantity')
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
