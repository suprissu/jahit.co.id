@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    partner: @json($partner),
    materials: @json($materials),
    requestsAll: @json($requestsAll),
    requestsRequested: @json($requestsRequested),
    requestsApproved: @json($requestsApproved),
    requestsSent: @json($requestsSent),
    requestsRejected: @json($requestsRejected),
}
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="partner-transaction"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
