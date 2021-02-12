@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')
@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/chatbox.css') }}"/>
@endsection

@section('content')
@include('layouts/modalAdminAddChat')
@inject('roleConstants', 'App\Constant\RoleConstant')

<div class="userChat">
    <div class="userChat__container">
        <div class="row mx-0 align-items-center">
            <h2 class="userChat__title">Pesan</h2>
            <!-- <button data-target="#adminAddChat" data-toggle="modal" class="chatbox__addMessage btn btn-danger ml-2"><i class="fas fa-plus" aria-hidden="true"></i></button> -->
        </div>
        <div class="chatbox">
            <div class="chatbox__navigation navigation list-group" role="tablist">

                <!-- Navigation Item -->
                @foreach ( $inboxes as $inbox )
                <a class="navigation__item" id="{{ $inbox->id }}" aria-controls="user">
                        <div class="navigation__left">
                            <h5 class="navigation__title">@if ($inbox->receiver->roles->first()->name == $roleConstants::PARTNER) {{$inbox->receiver->partner->company_name}} [VENDOR] @else {{$inbox->receiver->customer->company_name}} [CUSTOMER] @endif </h5>
                            <p class="navigation__description">{{ $inbox->adminChats->last()->message }}</p>
                        </div>
                        <div class="navigation__right">
                            <p class="navigation__date">{{ $inbox->adminChats->last()->created_at->format('j F Y') }}</p>
                        </div>
                </a>
                @endforeach

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
                        <div class="chatbox__messages__wrapper" id="content-user-{{ $inbox->id }}">
                            @foreach ( $inbox->adminChats->sortByDesc('updated_at') as $chat )
                                @if ( $chat->role == $roleConstants::ADMINISTRATOR )
                                    <div class="chatbox__message chatbox__message--me">
                                @else
                                    <div class="chatbox__message chatbox__message--other">
                                @endif
                                    <p>{{ $chat->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    
                    <div class="chatbox__input">
                        <form action="{{ route('home.inbox.replyAdmin', ['inboxId' => -1]) }}" method="POST">
                            @csrf
                            <input id="message" name="message" placeholder="Masukkan pesan anda di sini" type="text" class="form-control">
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
        $(".navigation__item").removeClass("active");
        const nav = e.currentTarget;
        nav.classList.add("active");

        $(".chatbox__noMessages__wrapper").hide()
        $(".chatbox__messages__wrapper").hide()
        const userId = e.currentTarget.attributes["id"].value;
        const userName = e.currentTarget.children[0].children[0].innerText;
        $(`#content-user-${userId}`).show()
        $(".chatbox__title").text(userName)
        $(".chatbox__input").show()
        $(".chatbox__input form").attr("action", `/home/inbox/chatAdmin/${userId}`)
        $(".chatbox__input form #message").val("")
        $(".chatbox__header").show()
    })
    
    $(".listAdminAddChat__item").on("click", (e) => {
        const userId = e.currentTarget.children[0].innerText
        const userName = e.currentTarget.children[1].innerText
        $(".chatbox__noMessages__wrapper").show()
        $(".chatbox__messages__wrapper").hide()
        $(".chatbox__title").text(userName)
        $(".chatbox__input").show()
        $(".chatbox__input form").attr("action", `/home/inbox/chatAdmin/${userId}`)
        $(".chatbox__input form #message").val("")
        $(".chatbox__header").show()
    })
</script>
@endsection
