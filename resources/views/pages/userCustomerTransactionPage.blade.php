@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userCustomerTransaction.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endsection

@section('content')

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
                    
                    <!-- TODO: Modal Item -->
                    <div class="modal fade pl-0" id="editTransaction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="auth-form" method="POST" action="">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <span class="badge badge-secondary">Menunggu Pembayaran</span>
                                        <h4>Penyelenggara Relawan COVID</h4>
                                        <h5 class="text-danger">Rp.1.300.000</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade pl-0" id="uploadPayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="auth-form" method="POST" action="">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4>Upload Bukti Pembayaran</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="listItem">
                        <div class="listItem--left" data-toggle="modal"
                            data-target="#editTransaction">
                            <div class="listItem__header">
                                <h5 class="listItem__name mb-0">Penyelenggara Relawan COVID</h5>
                                <p class="listItem__price">Rp.13.000</p>
                                <p class="listItem__amount">13.000 buah</p>
                            </div>
                        </div>
                        <div class="listItem--right">
                            <div class="listItem__label" data-toggle="modal"
                                data-target="#editTransaction">
                                <p class="listItem__category">Sample</p>
                                <p class="listItem__paidStatus">Belum Dibayar</p>
                                <!-- Uncomment if paidStatus is not SUDAH DIBAYAR -->
                                <!-- <div class="listItem__status--progress progress"><div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><p>40 Hari Lagi</p></div></div> -->
                            </div>
                            <div class="listItem__credential">
                                <!-- Uncomment one of element if paidStatus is BELUM DIBAYAR or SUDAH DIBAYAR  -->
                                <!-- <button class="btn btn-outline-danger mr-0" data-toggle="modal" data-target="#uploadPayment">Unggah Bukti Pembayaran</button> -->
                                <!-- <a href="#"><button class="btn btn-outline-danger mr-0">Unduh MOU</button></a> -->
                                <a href="#"><button class="btn btn-outline-danger mr-0">Unduh Invoice</button></a>
                            </div>
                        </div>
                    </div>
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
