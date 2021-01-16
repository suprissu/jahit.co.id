@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
    const dummyData = [
        {
            id: "12d11dx",
            name: "Relawan Covid A",
            price: "120000",
            start_date: "10/05/2020, 12:38:00 AM",
            end_date: "10/30/2020, 12:38:00 AM",
        },
        {
            id: "12d11da",
            name: "Demo Omnibus Law A",
            price: "120000",
            start_date: "10/05/2020, 12:38:00 AM",
            end_date: "10/30/2020, 12:38:00 AM",
        },
    ]

    function getTransactionData(id) {

        const data = dummyData.find((data) => data.id == id);
        const name = data.name
        const price = data.price
        const start_date = new Date(data.start_date)
        const end_date = new Date(data.end_date)

        return {
            id,
            name,
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
        const today = new Date().getTime();
        const difference = endDate - today + new Date().getTimezoneOffset() * 60000;
        const remainingDay = difference / (1000 * 3600 * 24);
        if (remainingDay > 1) return Math.round(remainingDay) + " hari lagi";
        else if (remainingDay * 24 > 1)
            return Math.round(remainingDay * 24) + " jam lagi";
        else if (remainingDay * 24 * 60 > 1) return Math.round(remainingDay * 24 * 60) + "menit lagi";
        else return "selesai"
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
@inject('materialRequestStatusConstant', 'App\Constant\MaterialRequestStatusConstant')

<div class="userCustomerTransaction">
    <div class="userCustomerTransaction__container">
        <div class="userCustomerTransaction__header">
            <h2 class="userCustomerTransaction__title">Transaksi</h2>
            <a href="{{ route('home.transaction.material.request.page') }}"><button class="btn btn-danger">Minta bahan</button></a>
        </div>
        <div class="userCustomerTransaction__transactions">
            <div class="userCustomerTransaction__transactions__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Semua</a>
                <a class="list-group-item list-group-item-action" id="list-material-list" data-toggle="list" href="#list-material" role="tab" aria-controls="sample">Diajukan</a>
                <a class="list-group-item list-group-item-action" id="list-accept-list" data-toggle="list" href="#list-accept" role="tab" aria-controls="accept">Disetujui</a>
                <a class="list-group-item list-group-item-action" id="list-sent-list" data-toggle="list" href="#list-sent" role="tab" aria-controls="sent">Dikirim</a>
                <a class="list-group-item list-group-item-action" id="list-cancel-list" data-toggle="list" href="#list-cancel" role="tab" aria-controls="cancel">Dibatalkan</a>
            </div>
            <div class="userCustomerTransaction__transactions__list header tab-content" id="nav-tabContent">
                
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $requestsAll as $project )
                        <div class="listItem">
                            <a href="/user/customer/transaction/1" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $project->name }}</h5>
                                    <p class="listItem__price">{{ $project->materialRequests->count() }} Pesanan</p>
                                    <div class="listItem__material">
                                        <p class="listItem__material__title">Bahan:</p>
                                        @foreach ( $project->materialRequests as $materialRequest )
                                        <p class="listItem__material__description">{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }} @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '[' . $materialRequest->status . ']' }}</i></span></p>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
                <div class="tab-pane fade" id="list-material" role="tabpanel" aria-labelledby="list-material-list">
                    @foreach( $requestsRequested as $project )
                        <div class="listItem">
                            <a href="/user/customer/transaction/1" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $project->name }}</h5>
                                    <p class="listItem__price">{{ $project->materialRequests->count() }} Pesanan</p>
                                    <div class="listItem__material">
                                        <p class="listItem__material__title">Bahan:</p>
                                        @foreach ( $project->materialRequests as $materialRequest )
                                            @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED)
                                                <p class="listItem__material__description">{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }} @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '[' . $materialRequest->status . ']' }}</i></span></p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
                <div class="tab-pane fade" id="list-accept" role="tabpanel" aria-labelledby="list-accept-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $requestsApproved as $project )
                        <div class="listItem">
                            <a href="/user/customer/transaction/1" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $project->name }}</h5>
                                    <p class="listItem__price">{{ $project->materialRequests->count() }} Pesanan</p>
                                    <div class="listItem__material">
                                        <p class="listItem__material__title">Bahan:</p>
                                        @foreach ( $project->materialRequests as $materialRequest )
                                            @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED)
                                                <p class="listItem__material__description">{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }} @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '[' . $materialRequest->status . ']' }}</i></span></p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
                <div class="tab-pane fade" id="list-sent" role="tabpanel" aria-labelledby="list-sent-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $requestsSent as $project )
                        <div class="listItem">
                            <a href="/user/customer/transaction/1" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $project->name }}</h5>
                                    <p class="listItem__price">{{ $project->materialRequests->count() }} Pesanan</p>
                                    <div class="listItem__material">
                                        <p class="listItem__material__title">Bahan:</p>
                                        @foreach ( $project->materialRequests as $materialRequest )
                                            @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT)
                                                <p class="listItem__material__description">{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }} @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '[' . $materialRequest->status . ']' }}</i></span></p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="tab-pane fade" id="list-cancel" role="tabpanel" aria-labelledby="list-cancel-list">
                    <!-- TODO: Make List Item -->
                    @foreach( $requestsRejected as $project )
                        <div class="listItem">
                            <a href="/user/customer/transaction/1" class="listItem--left">
                                <div class="listItem__header">
                                    <h5 class="listItem__name mb-0">{{ $project->name }}</h5>
                                    <p class="listItem__price">{{ $project->materialRequests->count() }} Pesanan</p>
                                    <div class="listItem__material">
                                        <p class="listItem__material__title">Bahan:</p>
                                        @foreach ( $project->materialRequests as $materialRequest )
                                            @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED)
                                                <p class="listItem__material__description">{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }} @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '[' . $materialRequest->status . ']' }}</i></span></p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
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

    $("button[data-target='#uploadPayment']").on("click", (e) => {
        const id = e.target.getAttribute("data-modalId")
        const data = getTransactionData(id);
        $("#payment-id-text").text(data.id);
        $("#payment-name-text").text(data.name);
        $("#payment-price-text").text(data.price);
        $("#payment-id").val(data.id);
    })
</script>
@endsection
