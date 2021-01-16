@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userTransactionDetail.css') }}">
@endsection

@section('content')
<div class="userTransactionDetail">
    <div class="userTransactionDetail__container">
        <div class="userTransactionDetail__header">
            <h2>Detail Transaksi #123</h2>
        </div>
        <h4>Rompi Relawan Covid</h4>
        <p>Mulai Pengerjaan: 10 Maret 2020</p>
        <p>Selesai Pengerjaan: 20 Maret 2020</p>
        <p>Estimasi Kedatangan: 3 hari</p>
        <p>Pelunasan: Rp. 750.000</p>
        <p>Harga: Rp. 1.000.000</p>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
