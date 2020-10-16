@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script src="{{ asset('js/userCustomerTransaction.js') }}"></script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userCustomerTransaction.css') }}">
@endsection

@section('content')
@include('layouts/modalTransaction')

<div class="userCustomerTransaction">
    <div class="userCustomerTransaction__container">
        <div class="userCustomerTransaction__header">
            <h2 class="userCustomerTransaction__title">Transaksi</h2>
        </div>
        <div class="userCustomerTransaction__transactions">
            <div class="userCustomerTransaction__transactions__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Semua</a>
                <a class="list-group-item list-group-item-action" id="list-sample-list" data-toggle="list" href="#list-sample" role="tab" aria-controls="sample">Sample</a>
                <a class="list-group-item list-group-item-action" id="list-deposit-list" data-toggle="list" href="#list-deposit" role="tab" aria-controls="deposit">Deposit</a>
                <a class="list-group-item list-group-item-action" id="list-repayment-list" data-toggle="list" href="#list-repayment" role="tab" aria-controls="repayment">Pelunasan</a>
            </div>
            <div class="userCustomerTransaction__transactions__list header tab-content" id="nav-tabContent">
                
                <!-- Semua Transaksi -->
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: Make List Item -->
                    <transaction-item
                        name="Penyelenggara Relawan COVID"
                        preview="{{ asset('img/hero-image.jpg') }}"
                        startDate="2020-10-03T21:20:37.613Z"
                        endDate="2020-12-10T21:20:37.613Z"
                        price="13.000"
                        amount="13.000"
                        paidStatus="BELUM_DIBAYAR"
                        category="SAMPLE"
                        data-toggle="modal" data-target="#editTransaction"
                        css="{{ asset('css/transactionItem.css') }}">
                    </transaction-item>
                    <transaction-item
                        name="Seragam SMAN 4 Depok"
                        preview="{{ asset('img/hero-image.jpg') }}"
                        startDate="2020-10-03T21:20:37.613Z"
                        endDate="2020-12-10T21:20:37.613Z"
                        price="20.000"
                        amount="20.000"
                        paidStatus="MENUNGGU_VERIFIKASI"
                        category="DEPOSIT"
                        data-toggle="modal" data-target="#editTransaction"
                        css="{{ asset('css/transactionItem.css') }}">
                    </transaction-item>
                    <transaction-item
                        name="Seragam Kantor"
                        preview="{{ asset('img/hero-image.jpg') }}"
                        startDate="2020-10-03T21:20:37.613Z"
                        endDate="2020-12-10T21:20:37.613Z"
                        price="24.000"
                        amount="24.000"
                        paidStatus="SUDAH_DIBAYAR"
                        category="PELUNASAN"
                        data-toggle="modal" data-target="#editTransaction"
                        css="{{ asset('css/transactionItem.css') }}">
                    </transaction-item>
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-sample" role="tabpanel" aria-labelledby="list-sample-list">
                </div>
                
                <!-- Transaksi Dalam Pengerjaan -->
                <div class="tab-pane fade" id="list-deposit" role="tabpanel" aria-labelledby="list-deposit-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Transaksi Selesai -->
                <div class="tab-pane fade" id="list-repayment" role="tabpanel" aria-labelledby="list-repayment-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Transaksi Dibatalkan -->
                <div class="tab-pane fade" id="list-cancel" role="tabpanel" aria-labelledby="list-cancel-list">
                    <!-- TODO: Make List Item -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
