@extends('layouts.base')

@section('title', 'Transaksi')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
window.props = {
    transactions: @json($transactions),
    sample_transactions: @json($sample_transactions),
    dp_transactions: @json($dp_transactions),
    full_transactions: @json($full_transactions),
}
</script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="customer-transaction"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
