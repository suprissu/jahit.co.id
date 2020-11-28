@extends('layouts.base')

@section('title', 'Inbox Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
    const chatProject = [
        @foreach( $inboxes as $inbox )
            {
                id: "{{ $inbox->id }}",
                userRole: "{{ $role }}",
                project: {
                    id: "{{ $inbox->project->id }}",
                    name: "{{ $inbox->project->name }}",
                    amount: "{{ $inbox->project->count }}",
                    price: "{{ $inbox->project->cost }}",
                    start_date: "{{ $inbox->project->start_date }}",
                    end_date: "{{ $inbox->project->end_date }}",
                    note: "{{ $inbox->project->note }}",
                },
                transaction: {
                    id: "{{ $inbox->project->name }}",
                },
                message: [
                    @foreach( $inbox->chats as $chat )
                        {
                            role: "{{ $chat->role }}",
                            type: "{{ $chat->type }}",
                            @if( $chat->accept != null )
                                answer: "{{ $chat->accept }}",
                            @endif
                            @if( $chat->excuse != null )
                                excuse: "{{ $chat->excuse }}",
                            @endif
                        },
                    @endforeach
                ],
            },
        @endforeach
    ];
</script>
@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalChatNegotiation')
@include('layouts/modalChatNegotiationAccept')
@include('layouts/modalChatProjectPermission')
@include('layouts/modalChatAskSample')
<div class="userChat">
    <div class="userChat__container">
        <h2 class="userChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation">
                <div class="navigation__story"></div>

                @foreach( $inboxes as $inbox )
                    <div class="navigation__item" data-id="{{ $inbox->id }}">
                        <div class="navigation__left">
                            <h5 class="navigation__title">{{ $inbox->partner->company_name }}</h5>
                            <p class="navigation__description">{{ $inbox->project->name }}</p>
                        </div>
                        <div class="navigation__right">
                            <p class="navigation__date">{{ $inbox->chats->last()->created_at->format('j F Y') }}</p>
                        </div>
                    </div>
                @endforeach
               
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
<script src="{{ asset('js/chatTemplate.js') }}"></script>
<script src="{{ asset('js/userChat.js') }}"></script>
@endsection
