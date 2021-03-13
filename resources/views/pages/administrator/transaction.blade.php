@extends('layouts.base')

@section('title', 'Payment Verification')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    transactionsCheck: @json($transactionsCheck),
    transactionsVerified: @json($transactionsVerified),
    transactionsFailed: @json($transactionsFailed)
}
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
@inject('transactionConstant', 'App\Constant\TransactionConstant')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="admin-transaction"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
