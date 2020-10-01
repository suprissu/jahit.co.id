@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script>var projectData = [{
        name: "",
        price: "",
        amount: "",
        quotation: "",
        badge: ""
    }]</script>
    <script src="{{ asset('js/userCustomerProject.js') }}"></script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userCustomerProject.css') }}">
@endsection

@section('content')
<div class="userCustomerProject">
    <div class="userCustomerProject__container">
        <div class="userCustomerProject__header">
            <h1 class="userCustomerProject__title">Proyek</h1>
            <button class="userCustomerProject__addProject btn btn-danger">Proyek</button>
        </div>
        <div class="userCustomerProject__projects">
            <div class="userCustomerProject__projects__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Semua</a>
                <a class="list-group-item list-group-item-action" id="list-open-quotation-list" data-toggle="list" href="#list-open-quotation" role="tab" aria-controls="open-quotation">Penawaran Terbuka</a>
                <a class="list-group-item list-group-item-action" id="list-progress-list" data-toggle="list" href="#list-progress" role="tab" aria-controls="progress">Dalam Pengerjaan</a>
                <a class="list-group-item list-group-item-action" id="list-finish-list" data-toggle="list" href="#list-finish" role="tab" aria-controls="finish">Selesai</a>
                <a class="list-group-item list-group-item-action" id="list-cancel-list" data-toggle="list" href="#list-cancel" role="tab" aria-controls="cancel">Dibatalkan</a>
            </div>
            <div class="userCustomerProject__projects__list header tab-content" id="nav-tabContent">
                
                <!-- Semua Proyek -->
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-open-quotation" role="tabpanel" aria-labelledby="list-open-quotation-list">
                    <div class="userCustomerProject__project userCustomerProject__project--quotation">
                        <p class="userCustomerProject__project__name">Rompi Relawan COVID</p>
                        <p class="userCustomerProject__project__price">Rp.1.300.000</p>
                        <p class="userCustomerProject__project__amount">13.000 buah</p>
                        <p class="userCustomerProject__project__quotation">13 Quotation</p>
                        <div class="userCustomerProject__project__status">Rompi Relawan COVID</div>
                    </div> 
                    <div class="userCustomerProject__project userCustomerProject__project--quotation">
                        <p class="userCustomerProject__project__name">Rompi Relawan COVID</p>
                        <p class="userCustomerProject__project__price">Rp.1.300.000</p>
                        <p class="userCustomerProject__project__amount">13.000 buah</p>
                        <p class="userCustomerProject__project__quotation">13 Quotation</p>
                        <div class="userCustomerProject__project__status">Rompi Relawan COVID</div>
                    </div> 
                </div>
                
                <!-- Proyek Dalam Pengerjaan -->
                <div class="tab-pane fade" id="list-progress" role="tabpanel" aria-labelledby="list-progress-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Proyek Selesai -->
                <div class="tab-pane fade" id="list-finish" role="tabpanel" aria-labelledby="list-finish-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Proyek Dibatalkan -->
                <div class="tab-pane fade" id="list-cancel" role="tabpanel" aria-labelledby="list-cancel-list">
                    <!-- TODO: Make List Item -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
