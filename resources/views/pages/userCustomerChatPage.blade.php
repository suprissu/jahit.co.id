@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userCustomerChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalChatVendorNegotiation')
<div class="userCustomerChat">
    <div class="userCustomerChat__container">
        <h2 class="userCustomerChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation">
                <div class="navigation__item">
                    <div class="navigation__left">
                        <h5 class="navigation__title">Qwerty Visual</h5>
                        <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                    </div>
                    <div class="navigation__right">
                        <p class="navigation__date">10 Maret 2020</p>
                    </div>
                </div>
            </div>
            <div class="chatbox__container">
                <div class="chatbox__header">
                    <h6 class="chatbox__title">Qwerty Visual</h6>
                    <div class="chatbox__more">
                        <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="chatbox__messages">
                    <div>


                        <div class="chatbox__message chatbox__message--admin">
                            <p>Kedua pihak telah menyepakati penawaran Proyek <span>Rompi Relawan COVID (<a href="#" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">#123123</a>)</span>.</p>
                        </div>

                        <div class="chatbox__message chatbox__message--other">
                            <p class="chatbox__message__projectLabel">Proyek <a href="#">#123123</a></p>
                            <div class="chatbox__message__projectDetail">
                                <p class="chatbox__message__projectPrice">Rp. 1.500.000</p>
                                <h6 class="chatbox__message__projectTitle">Rompi Relawan COVID</h6>
                                <p class="chatbox__message__projectAmount">Jumlah pesanan: <strong>1.300 buah</strong></p>
                                <p class="chatbox__message__projectDeadline">Mulai: <strong>10 Maret 2020</strong></p>
                                <p class="chatbox__message__projectDeadline">Selesai: <strong>20 Maret 2020</strong></p>
                            </div>
                            <div class="chatbox__message__choice">
                                <button class="chatbox__message__reject btn btn-outline-danger">Nego</button>
                                <button class="chatbox__message__accept btn btn-danger">Setuju</button>
                            </div>
                        </div>

                        <div class="chatbox__message chatbox__message--admin">
                            <p>Transaksi <a href="#" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">#123123</a> telah diverifikasi.</p>
                        </div>

                        <div class="chatbox__message chatbox__message--me">
                            <div class="chatbox__message__description">
                                <p>Kamu mengajukan Proyek 1.300 buah Rompi Relawan COVID (<a href="#">#123123</a>) dengan:</p>
                                <p>Harga: <strong>Rp. 1.500.000</strong></p>
                                <p>Mulai Pengerjaan: <strong>10 Maret 2020</strong></p>
                                <p>Selesai Pengerjaan: <strong>20 Maret 2020</strong></p>
                            </div>
                        </div>

                        <div class="chatbox__message chatbox__message--other">
                            <p class="chatbox__message__projectLabel">Proyek <a href="#">#123123</a></p>
                            <div class="chatbox__message__projectDetail">
                                <h6 class="chatbox__message__projectTitle">Rompi Relawan COVID</h6>
                                <p class="chatbox__message__projectAmount">Jumlah: <strong>1.300 buah</strong></p>
                            </div>
                            <div class="chatbox__message__description">
                                <p>Ahmad telah menambah proyek. Ajukan penawaran sekarang!</p>
                            </div>
                            <div class="chatbox__message__choice">
                                <button class="chatbox__message__accept btn btn-danger" data-toggle="modal" data-target="#chatVendorNegotiation">Ajukan</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')

@endsection
