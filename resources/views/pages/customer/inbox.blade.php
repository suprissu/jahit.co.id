@extends('layouts.base')

@section('title', 'Inbox Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    inboxes: [
        @foreach( $inboxes as $inbox )
            {
                id: "{{ $inbox->id }}",
                customer_id: "{{ $inbox->customer_id }}",
                partner_id: "{{ $inbox->partner_id }}",
                project_id: "{{ $inbox->project_id }}",
                project: {
                    id: "{{ $inbox->project->id }}",
                    name: "{{ $inbox->project->name }}",
                    count: "{{ $inbox->project->count }}",
                    cost: "{{ $inbox->project->cost }}",
                    status: "{{ $inbox->project->status }}",
                    rating: "{{ $inbox->project->rating }}",
                    start_date: "{{ $inbox->project->start_date }}",
                    end_date: "{{ $inbox->project->end_date }}",
                    images: [@forEach( $inbox->project->images as $image) 
                            {
                                path: "{{ $image->path }}"
                            },
                            @endforeach],
                            category: @json($inbox->project->category),
                    note: "{{ $inbox->project->note }}",
                },
                partner: @json($inbox->partner),   
                transaction: {
                    id: "{{ $inbox->project->name }}",
                },
                chats: [
                    @foreach( $inbox->chats as $chat )
                        {
                            @inject('chatConstants', 'App\Constant\ChatTemplateConstant')
                            @if (($chat->type != $chatConstants::NEGOTIATION_TYPE || $chat->answer != $chatConstants::BLANK_ANSWER || $chat->role != $role ) &&
                                ($chat->type != $chatConstants::NEGOTIATION_TYPE || $chat->answer != $chatConstants::REJECT_ANSWER || $chat->role != $role ) &&
                                ($chat->type != $chatConstants::PROJECT_OFFER_TYPE || $chat->role == $role ))
                                
                                id: "{{ $chat->id }}",
                                created_at: "{{ $chat->created_at }}",
                                role: "{{ $chat->role }}",
                                type: "{{ $chat->type }}",
                                answer: "{{ $chat->answer }}",
                                excuse: "{{ $chat->excuse }}",
                                negotiation: @json($chat->negotiation)
                            @endif
                        },
                    @endforeach
                ],
            },
        @endforeach
    ],
    userRole: @json($role)
}
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="inbox" ></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
