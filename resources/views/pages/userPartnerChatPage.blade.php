@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
    const chatProject = [
    {
        id: "111",
        userRole: "VENDOR",
        project: {
            id: "123123",
            name: "Relawan Rompi COVID",
            amount: "13000",
            price: "1000000",
            start_date: "2020-10-29T03:59:09",
            end_date: "2020-11-01T03:59:09",
            note: "test",
        },
        transaction: {
            id: "123111",
        },
        message: [
            {
                role: "CLIENT",
                type: "INISIASI",
                answer: "accept"
            },
            {
                role: "VENDOR",
                type: "DIAJUKAN",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "CLIENT",
                type: "SETUJU",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
        ],
    },
    {
        id: "123",
        userRole: "VENDOR",
        project: {
            id: "123123",
            name: "Relawan Rompi COVID",
            amount: "15000",
            price: "2000000",
            start_date: "2020-10-29T03:59:09",
            end_date: "2020-11-01T03:59:09",
            note: "test123",
        },
        transaction: {
            id: "123111",
        },
        message: [
            {
                role: "CLIENT",
                type: "INISIASI",
                answer: "reject"
            },
            {
                role: "VENDOR",
                type: "DIAJUKAN",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "CLIENT",
                type: "NEGOSIASI",
                answer: "accept",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "VENDOR",
                type: "SETUJU",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
        ],
    },
    {
        id: "333",
        userRole: "VENDOR",
        project: {
            id: "123123",
            name: "Relawan Rompi COVID",
            amount: "15000",
            price: "2000000",
            start_date: "2020-10-29T03:59:09",
            end_date: "2020-11-01T03:59:09",
            note: "test123",
        },
        transaction: {
            id: "123",
        },
        message: [
            {
                role: "CLIENT",
                answer: "accept",
                type: "INISIASI",
            },
            {
                role: "VENDOR",
                type: "DIAJUKAN",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "CLIENT",
                type: "NEGOSIASI",
                answer: "accept",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "VENDOR",
                type: "SETUJU",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "CLIENT",
                type: "SAMPLE",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "ADMIN",
                type: "VERIFIKASI",
            },
            {
                role: "VENDOR",
                answer: "deal",
                type: "SAMPLE TERKIRIM",
                negotiation: {
                    price: "1000000",
                    start_date: "2020-10-29T03:59:09",
                    end_date: "2020-11-01T03:59:09",
                }
            },
            {
                role: "CLIENT",
                type: "DEAL",
            },
            {
                role: "ADMIN",
                type: "VERIFIKASI",
            },
            {
                role: "CLIENT",
                type: "REVISI DIAJUKAN",
            },
            {
                role: "VENDOR",
                excuse: "Waktu tidak tersedia",
                type: "REVISI DITOLAK",
            },
        ],
    },
];
</script>
@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalChatNegotiation')
@include('layouts/modalChatInitiationReject')
@include('layouts/modalChatRevisionAccept')
@include('layouts/modalChatRevisionReject')
<div class="userChat">
    <div class="userChat__container">
        <h2 class="userChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation">
                <div class="navigation__story">
                    <div class="navigation__item" data-id="111">R</div>
                    <div class="navigation__item" data-id="111">R</div>
                    <div class="navigation__item" data-id="111">R</div>
                </div>

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

                <div class="navigation__item" data-id="333">
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
<script src="{{ asset('js/userChat.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script src="{{ asset('js/chatTemplate.js') }}"></script>
@endsection
