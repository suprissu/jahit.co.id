@extends('layouts.base')

@section('title', 'Inbox Partner')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script>
        const chatProject = [
            {
                id: "_OFFER_",
                userRole: "{{ $role }}",
                customerId: "-",
                partnerId: "{{ $partner->id }}",
                projectId: "-",
                project: {
                    id: "-",
                    name: "-",
                    amount: "-",
                    price: "-",
                    start_date: "-",
                    end_date: "-",
                    note: "-",
                },
                transaction: {
                    id: "-",
                },
                message: [
                    @foreach( $offers as $chat )
                    @inject('chatConstants', 'App\Constant\ChatTemplateConstant')
                    @if( $chat->answer != $chatConstants::REJECT_ANSWER)
                        {
                            id: "{{ $chat->id }}",
                            role: "{{ $chat->role }}",
                            type: "{{ $chat->type }}",
                            @if( $chat->answer != null )
                                answer: "{{ $chat->answer }}",
                            @endif
                            @if( $chat->excuse != null )
                                excuse: "{{ $chat->excuse }}",
                            @endif
                            customerId: "{{ $chat->inbox->customer_id }}",
                            partnerId: "{{ $chat->inbox->partner_id }}",
                            projectId: "{{ $chat->inbox->project_id }}",
                            inboxId: "{{ $chat->inbox->id }}",
                            project: {
                                id: "{{ $chat->inbox->project->id }}",
                                name: "{{ $chat->inbox->project->name }}",
                                amount: "{{ $chat->inbox->project->count }}",
                                price: "{{ $chat->inbox->project->cost }}",
                                start_date: "{{ $chat->inbox->project->start_date }}",
                                end_date: "{{ $chat->inbox->project->end_date }}",
                                note: "{{ $chat->inbox->project->note }}",
                            },
                        },
                    @endif
                    @endforeach
                ],
            },
            @foreach( $inboxes as $inbox )
                {
                    id: "{{ $inbox->id }}",
                    userRole: "{{ $role }}",
                    customerId: "{{ $inbox->customer_id }}",
                    partnerId: "{{ $inbox->partner_id }}",
                    projectId: "{{ $inbox->project_id }}",
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
                                @inject('chatConstants', 'App\Constant\ChatTemplateConstant')
                                @if (($chat->type != $chatConstants::NEGOTIATION_TYPE || $chat->answer != $chatConstants::BLANK_ANSWER || $chat->role != $role ) &&
                                    ($chat->type != $chatConstants::NEGOTIATION_TYPE || $chat->answer != $chatConstants::REJECT_ANSWER || $chat->role != $role ) &&
                                    ($chat->type != $chatConstants::PROJECT_OFFER_TYPE || $chat->role == $role ))
                                        
                                    id: "{{ $chat->id }}",
                                    role: "{{ $chat->role }}",
                                    type: "{{ $chat->type }}",
                                    @if( $chat->answer != null )
                                        answer: "{{ $chat->answer }}",
                                    @endif
                                    @if( $chat->excuse != null )
                                        excuse: "{{ $chat->excuse }}",
                                    @endif
                                    @if( $chat->negotiation != null )
                                    negotiation: {
                                            id : "{{ $chat->negotiation->id }}",
                                            price: "{{ $chat->negotiation->cost }}",
                                            start_date: "{{ $chat->negotiation->start_date }}",
                                            end_date: "{{ $chat->negotiation->deadline }}",
                                        },
                                    @endif
                                @endif
                            },
                        @endforeach
                    ],
                },
            @endforeach
        ];

        function getInboxData(id) {

            const data = chatProject.find((data) => data.id == id);

            const userRole = data.userRole
            const customerId = data.customerId
            const partnerId = data.partnerId
            const projectId = data.projectId
            const project = data.project
            const transaction = data.transaction
            const message = data.message

            return {
                id,
                userRole,
                customerId,
                partnerId,
                projectId,
                project,
                transaction,
                message
            }
        }
    </script>
@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userChat.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endsection

@section('content')
@include('layouts/modalChatNegotiation')
@include('layouts/modalChatNegotiationAccept')
@include('layouts/modalChatInitiationReject')
@include('layouts/modalChatRevisionAccept')
@include('layouts/modalChatRevisionReject')
<div class="userChat">
    <div class="userChat__container">
        <h2 class="userChat__title">Pesan</h2>
        <div class="chatbox">
            <div class="chatbox__navigation navigation">
                <div class="navigation__story"></div>

                <div class="navigation__item" data-id="_OFFER_">
                    <div class="navigation__left">
                        <h5 class="navigation__title">Penawaran</h5>
                        <p class="navigation__description">{{ $offers->count() }} penawaran</p>
                    </div>
                    <div class="navigation__right">
                        <p class="navigation__date">{{ $offerLastDate }}</p>
                    </div>
                </div>

                @foreach( $inboxes as $inbox )
                    @if ( $inbox->chats->count() > 1 )
                        <div class="navigation__item" data-id="{{ $inbox->id }}">
                            <div class="navigation__left">
                                <h5 class="navigation__title">{{ $inbox->customer->company_name }}</h5>
                                <p class="navigation__description">{{ $inbox->project->name }}</p>
                            </div>
                            <div class="navigation__right">
                                <p class="navigation__date">{{ $inbox->chats->last()->created_at->format('j F Y') }}</p>
                            </div>
                        </div>
                    @endif
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
<script>

    var changeModalChatNegotiation = function(e) {
        const projectID = e.getAttribute("data-projectId");
        const customerID = e.getAttribute("data-customerId");
        const partnerID = e.getAttribute("data-partnerId");
        const inboxID = e.getAttribute("data-inboxId");
        const chatID = e.getAttribute("data-chatId");

        $(".negotiation-project-id").val(projectID);
        $(".negotiation-customer-id").val(customerID);
        $(".negotiation-partner-id").val(partnerID);
        $(".negotiation-inbox-id").val(inboxID);
        $(".negotiation-chat-id").val(chatID);

        $("#chat-negotiation-form").attr("action", "{{ route('home.inbox.nego.offer') }}");
        $("#chat-negotiation-form").append('@csrf');

    }

    var changeModalChatInitiationReject = function(e) {
        const chatID = e.getAttribute("data-chatId");

        $(".negotiation-chat-id").val(chatID);

        $("#chat-initiation-reject-form").attr("action", "{{ route('home.inbox.nego.reject') }}");
        $("#chat-initiation-reject-form").append('@csrf');

    }

    var changeModalChatNegotiationAccept = function(e) {
        const inboxID = e.getAttribute("data-inboxId");
        const chatID = e.getAttribute("data-chatId");
        const negotiationID = e.getAttribute("data-negotiationId");

        $(".negotiation-inbox-id").val(inboxID);
        $(".negotiation-chat-id").val(chatID);
        $(".negotiation-negotiation-id").val(negotiationID);

        $("#chat-negotiation-accept-form").attr("action", "{{ route('home.inbox.nego.accept') }}");
        $("#chat-negotiation-accept-form").append('@csrf');
    }
    
</script>
<script src="{{ asset('js/chatTemplate.js') }}"></script>
<script src="{{ asset('js/userChat.js') }}"></script>
@endsection
