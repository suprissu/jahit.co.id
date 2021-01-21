@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')
@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/adminChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalAdminAddChat')
@inject('chatConstants', 'App\Constant\ChatTemplateConstant')

<div class="adminChat">
    <div class="adminChat__container">
        <h2 class="adminChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation list-group" role="tablist">

                <button data-target="#adminAddChat" data-toggle="modal" class="chatbox__addMessage btn btn-danger"><i class="fas fa-plus" aria-hidden="true"></i></button>

                <!-- Navigation Item -->
                @foreach ( $inboxes as $inbox )

                    <a class="navigation__item" id="ADM-{{ $inbox->id }}<" aria-controls="user">
                            <div class="navigation__left">
                                <h5 class="navigation__title">{{ $inbox->receiver->name }}</h5>
                                <p class="navigation__description">{{ $inbox->adminChats->last()->message }}</p>
                            </div>
                            <div class="navigation__right">
                                <p class="navigation__date">{{ $inbox->adminChats->last()->created_at->format('j F Y') }}</p>
                            </div>
                    </a>
                @endforeach
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
                    @foreach ( $inboxes as $inbox )
                        <div class="chatbox__messages__wrapper" id="content-user-ADM-{{ $inbox->id }}">
                            @foreach ( $inbox->adminChats as $chat )
                                @if ( $chat->role == $chatConstants::ADMIN_ROLE )
                                    <div class="chatbox__message chatbox__message--me">
                                @else
                                    <div class="chatbox__message chatbox__message--other">
                                @endif
                                    <p>{{ $chat->message }}</p>
                                </div>
                            @endforeach
                            <div class="chatbox__message chatbox__message--other">
                                <p>Kenapa ya saya tuh begini?</p>
                            </div>
                        </div>
                    @endforeach

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
