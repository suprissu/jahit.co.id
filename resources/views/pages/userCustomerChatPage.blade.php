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
                <div class="navigation__story"></div>

                <div class="navigation__item" data-id="111">
                    <div class="navigation__left">
                        <h5 class="navigation__title">Rompi Relawan COVID</h5>
                        <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                    </div>
                    <div class="navigation__right">
                        <p class="navigation__date">10 Maret 2020</p>
                    </div>
                </div>

                <div class="navigation__item" data-id="123">
                    <div class="navigation__left">
                        <h5 class="navigation__title">Rompi Relawan COVID</h5>
                        <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                    </div>
                    <div class="navigation__right">
                        <p class="navigation__date">10 Maret 2020</p>
                    </div>
                </div>
            </div>

            <div class="chatbox__container">
                <div class="chatbox__header">
                    <h6 class="chatbox__title">Rompi Relawan COVID</h6>
                    <!-- <div class="chatbox__more">
                        <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                    </div> -->
                </div>
                <div class="chatbox__messages">
                    <div class="chatbox__noMessages__wrapper">
                        <img src="{{ asset('img/empty-chat.svg') }}" alt="no-message"/>
                        <h5 class="chatbox__noMessages__title">Mulai transaksi untuk melihat chat.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/userCustomerChat.js') }}"></script>
<script src="{{ asset('js/customerChatTemplate.js') }}"></script>
@endsection
