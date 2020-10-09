@extends('layouts.base')

@section('title', 'Beranda')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script src="{{ asset('js/userCustomerProject.js') }}"></script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userCustomerProject.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
@include('layouts/modalAddProject')
@include('layouts/modalEditProject')

<div class="userCustomerProject">
    <div class="userCustomerProject__container">
        <div class="userCustomerProject__header">
            <h2 class="userCustomerProject__title">Proyek</h2>
            <button class="userCustomerProject__addProject btn btn-danger" data-toggle="modal" data-target="#addProject">Tambah Proyek</button>
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
                    <project-item name="Penyelenggara Relawan COVID" price="1.300.000" amount="13.000" quotation="13" status="1" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    <project-item name="Seragam SMAN 4 Depok" price="2.400.000" amount="20.000" quotation="11" status="2" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    <project-item name="Seragam Kantor" price="6.200.000" amount="24.000" quotation="14" startDate="2020-10-01T00:34:00Z" endDate="2020-10-30T00:00:00Z" status="3" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    <project-item name="Seragam Damkar" price="3.300.000" amount="50.000" quotation="12" status="4" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    <project-item name="Seragam Damkar" price="3.300.000" amount="50.000" quotation="12" review="rekomen bgt" rating="4" status="5" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    <project-item name="Seragam Damkar" price="3.300.000" amount="50.000" quotation="12" status="6" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-open-quotation" role="tabpanel" aria-labelledby="list-open-quotation-list">
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
<script src="{{ asset('js/form.js') }}"></script>
@endsection
