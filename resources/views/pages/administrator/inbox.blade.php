@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    inboxes: @json($inboxes),
    userRole: @json($role)
}
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
</script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="inbox"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
