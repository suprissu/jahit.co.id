@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
    const chatProject = [
    {
        id: "222",
        userRole: "CLIENT",
        project: {
            id: "123",
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
            },
            {
                role: "VENDOR",
                type: "NEGOSIASI",
                answer: "",
            },
        ],
    },
    {
        id: "111",
        userRole: "CLIENT",
        project: {
            id: "123",
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
            },
            {
                role: "VENDOR",
                type: "NEGOSIASI",
                answer: "accept",
            },
            {
                role: "CLIENT",
                type: "SETUJU",
            },
        ],
    },
    {
        id: "123",
        userRole: "CLIENT",
        project: {
            id: "123",
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
            },
            {
                role: "VENDOR",
                type: "NEGOSIASI",
                answer: "reject",
            },
            {
                role: "CLIENT",
                type: "DIAJUKAN",
            },
            {
                role: "VENDOR",
                type: "SETUJU",
            },
        ],
    },
    {
        id: "333",
        userRole: "CLIENT",
        project: {
            id: "123",
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
                type: "INISIASI",
            },
            {
                role: "VENDOR",
                answer: "reject",
                type: "NEGOSIASI",
            },
            {
                role: "CLIENT",
                type: "DIAJUKAN",
            },
            {
                role: "VENDOR",
                answer: "sample",
                type: "SETUJU",
            },
            {
                role: "CLIENT",
                type: "SAMPLE",
            },
            {
                role: "ADMIN",
                type: "VERIFIKASI",
            },
            {
                role: "VENDOR",
                answer: "deal",
                type: "SAMPLE TERKIRIM",
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
<link rel="stylesheet" href="{{ asset('css/adminChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalAdminAddChat')
<div class="adminChat">
    <div class="adminChat__container">
        <h2 class="adminChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation list-group" role="tablist">

                <button data-target="#adminAddChat" data-toggle="modal" class="chatbox__addMessage btn btn-danger"><i class="fas fa-plus" aria-hidden="true"></i></button>

                <!-- Navigation Item -->

                <a class="navigation__item" id="13123213" aria-controls="user">
                        <div class="navigation__left">
                            <h5 class="navigation__title">User 1</h5>
                            <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                        </div>
                        <div class="navigation__right">
                            <p class="navigation__date">10 Maret 2020</p>
                        </div>
                </a>
                <a class="navigation__item" id="32523524" aria-controls="user">
                        <div class="navigation__left">
                            <h5 class="navigation__title">User 2</h5>
                            <p class="navigation__description">Transaksi #123231 sudah terverifikasi . . .</p>
                        </div>
                        <div class="navigation__right">
                            <p class="navigation__date">10 Maret 2020</p>
                        </div>
                </a>

            </div>

            <div class="chatbox__container">
                <div class="chatbox__header">
                    <h6 class="chatbox__title"></h6>
                </div>
                <div class="chatbox__messages tab-content">
                    <div class="chatbox__noMessages__wrapper" id="no-chat">
                        <img src="{{ asset('img/empty-chat.svg') }}" alt="no-message"/>
                        <h5 class="chatbox__noMessages__title">Mulai transaksi untuk melihat chat.</h5>
                    </div>
                    
                    <!-- TODO: Change below component -->
                    
                    <div class="chatbox__messages__wrapper" id="content-user-13123213">
                        <div class="chatbox__message chatbox__message--me">
                            <p>Itu karena bapak tidak baca petunjuk</p>
                        </div>
                        <div class="chatbox__message chatbox__message--other">
                            <p>Kenapa ya saya tuh begini?</p>
                        </div>
                    </div>

                    <div class="chatbox__messages__wrapper" id="content-user-32523524">
                        <div class="chatbox__message chatbox__message--me">
                            <p>Halo juga</p>
                        </div>
                        <div class="chatbox__message chatbox__message--other">
                            <p>Halo min</p>
                        </div>
                    </div>
                    
                    <div class="chatbox__input">
                        <form action="" method="POST">
                            <input name="chat" placeholder="Masukkan pesan anda di sini" type="text" class="form-control">
                            <button type="submit" class="btn btn-danger">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(".chatbox__header").hide()
    $(".chatbox__input").hide()
    $(".chatbox__messages__wrapper").hide()
    $(".navigation__item").on("click", (e) => {
        $(".chatbox__noMessages__wrapper").hide()
        $(".chatbox__messages__wrapper").hide()
        const userId = e.currentTarget.attributes["id"].value;
        const userName = e.currentTarget.children[0].children[0].innerText;
        $(`#content-user-${userId}`).show()
        $(".chatbox__title").text(userName)
        $(".chatbox__input").show()
        console.log($(".chatbox__input form").attr("action"))
        $(".chatbox__input form").attr("action", `/admin/chat/${userId}/add`)
        $(".chatbox__input form input").val("")
        $(".chatbox__header").show()
    })
    
    $(".listAdminAddChat__item").on("click", (e) => {
        const userId = e.currentTarget.children[0].innerText
        const userName = e.currentTarget.children[1].innerText
        $(".chatbox__noMessages__wrapper").show()
        $(".chatbox__messages__wrapper").hide()
        $(".chatbox__title").text(userName)
        $(".chatbox__input").show()
        console.log($(".chatbox__input form").attr("action"))
        $(".chatbox__input form").attr("action", `/admin/chat/${userId}/add`)
        $(".chatbox__input form input").val("")
        $(".chatbox__header").show()
    })
</script>
@endsection
