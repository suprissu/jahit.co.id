@extends('layouts.base')

@section('title', 'Material Request')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    materials: @json($materials),
    requestsRequested: @json($requestsRequested),
    requestsApproved: @json($requestsApproved),
    requestsSent: @json($requestsSent),
    requestsRejected: @json($requestsRejected)
}
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="admin-material"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
