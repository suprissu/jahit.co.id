@extends('layouts.base')

@section('title', 'Payment Verification')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/tabular.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="tabular">
    <div class="tabular___container container">
        <h3 class="mb-3">Transaction Administrator</h3>
        <div class="row">
            <div class="col">
                <div class="tabular__header list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-waiting-list" data-toggle="list" href="#list-waiting" role="tab" aria-controls="customer">Menunggu Verifikasi</a>
                        <a class="list-group-item list-group-item-action" id="list-verified-list" data-toggle="list" href="#list-verified" role="tab" aria-controls="partner">Disetujui</a>
                        <a class="list-group-item list-group-item-action" id="list-reject-list" data-toggle="list" href="#list-reject" role="tab" aria-controls="project">Ditolak</a>
                </div>
                <div class="tabular__list header tab-content" id="nav-tabContent">
                    
                    <!-- Semua Proyek -->
                    <div class="tab-pane fade show active" id="list-waiting" role="tabpanel" aria-labelledby="list-waiting-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $transactionsCheck as $transaction )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <img class="rounded w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt=""/>
                                        </div>
                                        <div class="col mt-2">
                                            <a class="badge bg-light" href="">#{{ $transaction->id }}</a>
                                            <h4 class="mb-2">{{ $transaction->project->name }}</h4>
                                            <p class="mb-2">Rp {{ $transaction->cost }}</p>
                                            <p class="mb-2">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <form action="{{ route('home.administrator.verification.payment.submit') }}" method="POST">
                                                @csrf
                                                <input name="transactionID" value="{{ $transaction->id }}" class="transaction-id" type="text" style="display: none;" required>
                                                <select class="form-control" id="role-option" name="status" required>
                                                    @inject('transactionConstant', 'App\Constant\TransactionConstant')
                                                    <option @if( $transaction->status == $transactionConstant::PAY_IN_VERIF ) selected="selected" @endif value="WAITING">Menunggu Verifikasi</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_OK ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_FAIL ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                </select>
                                                <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    
                    <!-- Penawaran Terbuka -->
                    <div class="tab-pane fade" id="list-verified" role="tabpanel" aria-labelledby="list-verified-list">
                        @foreach( $transactionsVerified as $transaction )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <img class="rounded w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt=""/>
                                        </div>
                                        <div class="col mt-2">
                                            <a class="badge bg-light" href="">#{{ $transaction->id }}</a>
                                            <h4 class="mb-2">{{ $transaction->project->name }}</h4>
                                            <p class="mb-2">Rp {{ $transaction->cost }}</p>
                                            <p class="mb-2">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <form action="{{ route('home.administrator.verification.payment.submit') }}" method="POST">
                                                @csrf
                                                <input name="transactionID" value="{{ $transaction->id }}" class="transaction-id" type="text" style="display: none;" required>
                                                <select class="form-control" id="role-option" name="status" required>
                                                    @inject('transactionConstant', 'App\Constant\TransactionConstant')
                                                    <option @if( $transaction->status == $transactionConstant::PAY_IN_VERIF ) selected="selected" @endif value="WAITING">Menunggu Verifikasi</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_OK ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_FAIL ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                </select>
                                                <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    
                    <!-- Proyek Dalam Pengerjaan -->
                    <div class="tab-pane fade" id="list-reject" role="tabpanel" aria-labelledby="list-reject-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $transactionsFailed as $transaction )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <img class="rounded w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt=""/>
                                        </div>
                                        <div class="col mt-2">
                                            <a class="badge bg-light" href="">#{{ $transaction->id }}</a>
                                            <h4 class="mb-2">{{ $transaction->project->name }}</h4>
                                            <p class="mb-2">Rp {{ $transaction->cost }}</p>
                                            <p class="mb-2">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <form action="{{ route('home.administrator.verification.payment.submit') }}" method="POST">
                                                @csrf
                                                <input name="transactionID" value="{{ $transaction->id }}" class="transaction-id" type="text" style="display: none;" required>
                                                <select class="form-control" id="role-option" name="status" required>
                                                    @inject('transactionConstant', 'App\Constant\TransactionConstant')
                                                    <option @if( $transaction->status == $transactionConstant::PAY_IN_VERIF ) selected="selected" @endif value="WAITING">Menunggu Verifikasi</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_OK ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_FAIL ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                </select>
                                                <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('extra-js')
@endsection
