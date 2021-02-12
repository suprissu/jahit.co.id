@extends('layouts.base')

@section('title', 'Transaksi')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
    const dummyData = [
        @foreach( $transactions as $transaction )
            {
                id: "{{ $transaction->id }}",
                price: "{{ $transaction->cost }}",
                start_date: "{{ $transaction->created_at }}",
                end_date: "{{ $transaction->deadline }}",
            },
        @endforeach
        ]

        function getTransactionData(id) {

            const data = dummyData.find((data) => data.id == id);
            const price = data.price
            const start_date = data.start_date
            const end_date = data.end_date

            return {
                id,
                price,
                start_date,
                end_date,
            }
        }

    function getPercentage(start, end) {
        const startDate = new Date(start).getTime();
        const endDate = new Date(end).getTime();
        const today = new Date().getTime() + new Date().getTimezoneOffset() * 60000;
        const total = endDate - startDate;
        const indicator = today - startDate;
        const progress = indicator / total;
        return progress.toFixed(2) * 100;
    }

    function getRemainingDay(end) {
        const endDate = new Date(end).getTime();
        const today = new Date().getTime() + new Date().getTimezoneOffset() * 60000;
        const difference = endDate - today;
        const remainingDay = difference / (1000 * 3600 * 24);
        if (remainingDay > 1) return Math.round(remainingDay) + " hari lagi";
        else if (remainingDay * 24 > 1)
            return Math.round(remainingDay * 24) + " jam lagi";
        else if (remainingDay * 24 * 60 > 1) return Math.round(remainingDay * 24 * 60) + "menit lagi";
        else return "selesai"
    }
</script>
<script>
    var changeModalUploadPayment = function(e) {
        const id = e.getAttribute("data-transactionId")
        const data = getTransactionData(id);

        $(".payment-id-text").text(data.id);
        $(".payment-price-text").text(data.price);
        $(".transaction-id").val(data.id);
        $(".deadline").val(data.end_date);

        $("#upload-payment-form").attr("action", "{{ route('home.transaction.slip.submit') }}");
        $("#upload-payment-form").append('@csrf');
    }
</script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userCustomerTransaction.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
@include('layouts/modalUploadPayment')
@inject('transactionConstant', 'App\Constant\TransactionConstant')

<div class="userCustomerTransaction">
    <div class="userCustomerTransaction__container">
        <div class="userCustomerTransaction__header">
            <h2 class="userCustomerTransaction__title">Transaksi</h2>
        </div>
        <div class="userCustomerTransaction__transactions">
            <div class="userCustomerTransaction__transactions__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Bayar</a>
                <a class="list-group-item list-group-item-action" id="list-sample-list" data-toggle="list" href="#list-sample" role="tab" aria-controls="sample">Sampel</a>
                <a class="list-group-item list-group-item-action" id="list-deposit-list" data-toggle="list" href="#list-deposit" role="tab" aria-controls="deposit">Deposit</a>
                <a class="list-group-item list-group-item-action" id="list-repayment-list" data-toggle="list" href="#list-repayment" role="tab" aria-controls="repayment">Pelunasan</a>
            </div>
            <div class="userCustomerTransaction__transactions__list header tab-content" id="nav-tabContent">
                <!-- Semua Transaksi -->
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $transactions as $transaction )
                        <div class="listItem">
                            <a href="#" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $transaction->project->name }}</h5>
                                    <p class="listItem__price">Rp {{ number_format($transaction->cost, 2, ",", ".") }}</p>
                                    <p class="listItem__amount">{{ $transaction->project->count }} buah</p>
                                </div>
                            </a>
                            <div class="listItem--right">
                                <a href="#" class="listItem__label">
                                    <p class="listItem__category">{{ $transaction->type }}</p>
                                    <p class="listItem__paidStatus">{{ $transaction->status }}</p>
                                    <!-- Uncomment if paidStatus is not SUDAH DIBAYAR -->
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT)
                                        <div 
                                            data-startDate="{{ $transaction->created_at }}"
                                            data-endDate="{{ $transaction->deadline }}"
                                            class="listItem__status--progress progress">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    @endif
                                </a>
                                <div class="listItem__credential">
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT || $transaction->status == $transactionConstant::PAY_FAIL)
                                        <button onclick="changeModalUploadPayment(this)" data-transactionId="{{ $transaction->id }}" class="btn btn-outline-danger mr-0" data-toggle="modal" data-target="#uploadPayment">Unggah Bukti Pembayaran</button>
                                    @endif
                                    @if ($transaction->mou != null)
                                        <a href="{{ route('home.transaction.download.mou', ['mouId' => $transaction->mou->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh MOU</button></a>
                                    @endif
                                    @if ($transaction->invoice != null)
                                        <a href="{{ route('home.transaction.download.invoice', ['invoiceId' => $transaction->invoice->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh Invoice</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-sample" role="tabpanel" aria-labelledby="list-sample-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $sample_transactions as $transaction )
                        <div class="listItem">
                            <a href="#" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $transaction->project->name }}</h5>
                                    <p class="listItem__price">Rp {{ number_format($transaction->cost, 2, ",", ".") }}</p>
                                    <p class="listItem__amount">{{ $transaction->project->count }} buah</p>
                                </div>
                            </a>
                            <div class="listItem--right">
                                <a href="#" class="listItem__label">
                                    <p class="listItem__category">{{ $transaction->type }}</p>
                                    <p class="listItem__paidStatus">{{ $transaction->status }}</p>
                                    <!-- Uncomment if paidStatus is not SUDAH DIBAYAR -->
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT)
                                        <div 
                                            data-startDate="{{ $transaction->created_at }}"
                                            data-endDate="{{ $transaction->deadline }}"
                                            class="listItem__status--progress progress">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    @endif
                                </a>
                                <div class="listItem__credential">
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT || $transaction->status == $transactionConstant::PAY_FAIL)
                                        <button data-modalId="12d11dx" class="btn btn-outline-danger mr-0" data-toggle="modal" data-target="#uploadPayment">Unggah Bukti Pembayaran</button>
                                    @endif
                                    @if ($transaction->mou != null)
                                        <a href="{{ route('home.transaction.download.mou', ['mouId' => $transaction->mou->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh MOU</button></a>
                                    @endif
                                    @if ($transaction->invoice != null)
                                        <a href="{{ route('home.transaction.download.invoice', ['invoiceId' => $transaction->invoice->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh Invoice</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Transaksi Dalam Pengerjaan -->
                <div class="tab-pane fade" id="list-deposit" role="tabpanel" aria-labelledby="list-deposit-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $dp_transactions as $transaction )
                        <div class="listItem">
                            <a href="#" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $transaction->project->name }}</h5>
                                    <p class="listItem__price">Rp {{ number_format($transaction->cost, 2, ",", ".") }}</p>
                                    <p class="listItem__amount">{{ $transaction->project->count }} buah</p>
                                </div>
                            </a>
                            <div class="listItem--right">
                                <a href="#" class="listItem__label">
                                    <p class="listItem__category">{{ $transaction->type }}</p>
                                    <p class="listItem__paidStatus">{{ $transaction->status }}</p>
                                    <!-- Uncomment if paidStatus is not SUDAH DIBAYAR -->
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT)
                                        <div 
                                            data-startDate="{{ $transaction->created_at }}"
                                            data-endDate="{{ $transaction->deadline }}"
                                            class="listItem__status--progress progress">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    @endif
                                </a>
                                <div class="listItem__credential">
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT || $transaction->status == $transactionConstant::PAY_FAIL)
                                        <button data-modalId="12d11dx" class="btn btn-outline-danger mr-0" data-toggle="modal" data-target="#uploadPayment">Unggah Bukti Pembayaran</button>
                                    @endif
                                    @if ($transaction->mou != null)
                                        <a href="{{ route('home.transaction.download.mou', ['mouId' => $transaction->mou->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh MOU</button></a>
                                    @endif
                                    @if ($transaction->invoice != null)
                                        <a href="{{ route('home.transaction.download.invoice', ['invoiceId' => $transaction->invoice->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh Invoice</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Transaksi Selesai -->
                <div class="tab-pane fade" id="list-repayment" role="tabpanel" aria-labelledby="list-repayment-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $full_transactions as $transaction )
                        <div class="listItem">
                            <a href="#" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $transaction->project->name }}</h5>
                                    <p class="listItem__price">Rp {{ number_format($transaction->cost, 2, ",", ".") }}</p>
                                    <p class="listItem__amount">{{ $transaction->project->count }} buah</p>
                                </div>
                            </a>
                            <div class="listItem--right">
                                <a href="#" class="listItem__label">
                                    <p class="listItem__category">{{ $transaction->type }}</p>
                                    <p class="listItem__paidStatus">{{ $transaction->status }}</p>
                                    <!-- Uncomment if paidStatus is not SUDAH DIBAYAR -->
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT)
                                        <div 
                                            data-startDate="{{ $transaction->created_at }}"
                                            data-endDate="{{ $transaction->deadline }}"
                                            class="listItem__status--progress progress">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    @endif
                                </a>
                                <div class="listItem__credential">
                                    @if ($transaction->status == $transactionConstant::PAY_WAIT || $transaction->status == $transactionConstant::PAY_FAIL)
                                        <button data-modalId="12d11dx" class="btn btn-outline-danger mr-0" data-toggle="modal" data-target="#uploadPayment">Unggah Bukti Pembayaran</button>
                                    @endif
                                    @if ($transaction->mou != null)
                                        <a href="{{ route('home.transaction.download.mou', ['mouId' => $transaction->mou->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh MOU</button></a>
                                    @endif
                                    @if ($transaction->invoice != null)
                                        <a href="{{ route('home.transaction.download.invoice', ['invoiceId' => $transaction->invoice->id]) }}"><button class="btn btn-outline-danger mr-0">Unduh Invoice</button></a>
                                    @endif
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
<script src="{{ asset('js/form.js') }}"></script>
<script>
    $(".listItem__status--progress").each((e, el) => {
        const startDate = el.getAttribute("data-startDate");
        const endDate = el.getAttribute("data-endDate");
        const percentage = getPercentage(startDate, endDate);
        const remainingDay = getRemainingDay(endDate)
        el.children[0].style.width = `${percentage !== Infinity ? percentage: 100}%`;
        if (percentage === Infinity || percentage > 100) {
            el.children[0].style.backgroundColor = "#1CAE94"
            el.children[0].style.color = "#fff"
        }
        el.children[0].innerHTML = `<p>${remainingDay}</p>`
    })
</script>
@endsection
