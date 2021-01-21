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
                    <div class="tab-pane fade show active tabular__pane" id="list-waiting" role="tabpanel" aria-labelledby="list-waiting-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $transactionsCheck as $transaction )
                            <div class="tabular__pane__item p-2 my-2">
                                <div class="tabular__pane__item__detail">
                                    <div class="tabular__pane__item__preview">
                                        <img class="img-thumbnail w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt="payment-slip" data-toggle="modal" data-target="#image-fullscreen"/>
                                    </div>
                                    <div class="tabular__pane__item__description mx-2">
                                        <div class="tabular__pane__item__description__main">
                                            <p class="text-muted fs-6 mb-0" style="font-size: 12px">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <div class="row mx-0">
                                                <p class="mb-0" style="font-weight: bold">{{ $transaction->project->name }}
                                                    <a class="badge bg-light ml-1" href="">#{{ $transaction->id }}</a>
                                                </p>
                                            </div>
                                            <p class="mb-2">Rp.{{ number_format($transaction->cost, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="tabular__pane__item__description__extra">
                                            <button class="btn btn-ouline-secondary"  data-toggle="collapse" data-target="#transaction-{{ $transaction->id  }}" aria-expanded="false" aria-controls="#order-{{ $transaction->id  }}">Detail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabular__pane__item__collapsible">
                                    <div class="collapse pt-3" id="transaction-{{$transaction->id }}">
                                            <form action="{{ route('home.administrator.verification.payment.submit') }}" method="POST">
                                                @csrf
                                                <input name="transactionID" value="{{ $transaction->id }}" class="transaction-id" type="text" style="display: none;" required>
                                                <select class="form-control" id="role-option" name="status" required>
                                                    @inject('transactionConstant', 'App\Constant\TransactionConstant')
                                                    <option @if( $transaction->status == $transactionConstant::PAY_IN_VERIF ) selected="selected" @endif value="WAITING">Menunggu Verifikasi</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_OK ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                    <option @if( $transaction->status == $transactionConstant::PAY_FAIL ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                </select>
                                                <p class="text-muted my-1">Upload MOU:</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="transactionMOU" name="transactionMOU">
                                                    <label class="custom-file-label" for="transactionMOU">Choose file</label>
                                                </div>
                                                <p class="text-muted my-1">Upload Invoice:</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="transactionINVOICE" name="transactionINVOICE">
                                                    <label class="custom-file-label" for="transactionINVOICE">Choose file</label>
                                                </div>
                                                <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Penawaran Terbuka -->
                    <div class="tab-pane fade tabular__pane" id="list-verified" role="tabpanel" aria-labelledby="list-verified-list">
                        @foreach( $transactionsVerified as $transaction )
                            <div class="tabular__pane__item p-2 my-2">
                                <div class="tabular__pane__item__detail">
                                    <div class="tabular__pane__item__preview">
                                        <img class="img-thumbnail w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt="payment-slip" data-toggle="modal" data-target="#image-fullscreen"/>
                                    </div>
                                    <div class="tabular__pane__item__description mx-2">
                                        <div class="tabular__pane__item__description__main">
                                            <p class="text-muted fs-6 mb-0" style="font-size: 12px">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <div class="row mx-0">
                                                <p class="mb-0" style="font-weight: bold">{{ $transaction->project->name }}
                                                    <a class="badge bg-light ml-1" href="">#{{ $transaction->id }}</a>
                                                </p>
                                            </div>
                                            <p class="mb-2">Rp.{{ number_format($transaction->cost, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="tabular__pane__item__description__extra">
                                            <a href=""><button class="btn btn-outline-danger">Download MOU</button></a>
                                            <a href=""><button class="btn btn-outline-danger">Download Invoice</button></a>
                                            <button class="btn btn-ouline-secondary"  data-toggle="collapse" data-target="#transaction-{{ $transaction->id  }}" aria-expanded="false" aria-controls="#order-{{ $transaction->id  }}">Detail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabular__pane__item__collapsible">
                                    <div class="collapse pt-3" id="transaction-{{$transaction->id }}">
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
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Proyek Dalam Pengerjaan -->
                    <div class="tab-pane fade tabular__pane" id="list-reject" role="tabpanel" aria-labelledby="list-reject-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $transactionsFailed as $transaction )
                            <div class="tabular__pane__item p-2 my-2">
                                <div class="tabular__pane__item__detail">
                                    <div class="tabular__pane__item__preview">
                                        <img class="img-thumbnail w-100" src="{{ asset( $transaction->paymentSlip->path ) }}" alt="payment-slip" data-toggle="modal" data-target="#image-fullscreen"/>
                                    </div>
                                    <div class="tabular__pane__item__description mx-2">
                                        <div class="tabular__pane__item__description__main">
                                            <p class="text-muted fs-6 mb-0" style="font-size: 12px">{{ $transaction->deadline->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <div class="row mx-0">
                                                <p class="mb-0" style="font-weight: bold">{{ $transaction->project->name }}
                                                    <a class="badge bg-light ml-1" href="">#{{ $transaction->id }}</a>
                                                </p>
                                            </div>
                                            <p class="mb-2">Rp.{{ number_format($transaction->cost, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="tabular__pane__item__description__extra">
                                            <button class="btn btn-ouline-secondary"  data-toggle="collapse" data-target="#transaction-{{ $transaction->id  }}" aria-expanded="false" aria-controls="#order-{{ $transaction->id  }}">Detail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabular__pane__item__collapsible">
                                    <div class="collapse pt-3" id="transaction-{{$transaction->id }}">
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('extra-js')
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
