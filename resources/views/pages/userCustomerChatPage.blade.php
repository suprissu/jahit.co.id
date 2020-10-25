@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userCustomerChat.css') }}"/>
@endsection

@section('content')
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
                <div class="navigation__item">
                    <div class="navigation__left">
                        <h5 class="navigation__title">Qwerty Visual</h5>
                        <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                    </div>
                    <div class="navigation__right">
                        <p class="navigation__date">10 Maret 2020</p>
                    </div>
                </div>
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
                        <div class="chatbox__message chatbox__message--other">
                            <p>Transaksi <a href="#">#123123</a> telah diverifikasi.</p>
                        </div>
                        <div class="chatbox__message chatbox__message--me">
                            <p>Transaksi <a href="#">#123123</a> telah diverifikasi.</p>
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
