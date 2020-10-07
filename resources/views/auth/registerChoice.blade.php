@extends('layouts.base')

@section('title', 'Pilih Daftar')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/choicePage.css') }}">
@endsection

@section('content')
<div class="choicePage">
    <div class="choicePage__container">
        <h2 class="choicePage__title">Sebagai apa kamu di Jahit.co.id ?</h2>
        <p class="choicePage__description">Untuk memudahkan identifikasi bantuan yang akan diberikan, silahkan pilih salah satu di bawah ini ya.</p>
        <div class="choicePage__choices">
            <div id="customer" class="choicePage__choice active">
                <img src="/img/customer-image.png" alt="customer-image" />
                <p>Pelanggan yang ingin mengajukan proyek jahit</p>
            </div>
            <div id="partner" class="choicePage__choice">
                <img src="/img/partner-image.png" alt="partner-image" />
                <p>Vendor penjahit yang ingin menjadi mitra Jahit.co.id</p>
            </div>
        </div>
        <form method="POST" action="{{ route('register.choice.submit') }}">
            @csrf
            <div class="d-none">
                <select id="role-option" name="role" required>
                    <option selected="selected" value="CUST">CUST</option>
                    <option value="PART">PART</option>
                </select>
            </div>
            <button class="choicePage__submit btn btn-danger" type="submit">Selanjutnya</button>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/choicePage.js') }}"></script>
@endsection
