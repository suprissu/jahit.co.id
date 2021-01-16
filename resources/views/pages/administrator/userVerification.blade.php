@extends('layouts.base')

@section('title', 'User Verification')

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
        <h3 class="mb-3">Verifikasi User Administrator</h3>
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
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#123123</span>
                                            <h4 class="mb-1">Qwerty Visual</h4>
                                            <p class="mb-1"><strong>Email:</strong> qwerty.vis@gmail.com</p>
                                            <p class="mb-1"><strong>Alamat:</strong> Jl. Petamburan</p>
                                            <p class="mb-1"><strong>Nomor Telepon:</strong> +6281231231</p>
                                            <div class="row">
                                                <div class="col-2">
                                                    <img data-toggle="modal" data-target="#imageShow-1" class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                                </div>
                                                <div class="col-2">
                                                    <img data-toggle="modal" data-target="#imageShow-2" class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                                </div>
                                            </div>
                                            <form class="mt-4" action="/admin/material" method="POST">
                                                <select class="form-control" id="role-option" name="role" required>
                                                    <option selected="selected" value="WAITING">Menunggu Verifikasi</option>
                                                    <option value="ACCEPT">Disetujui</option>
                                                    <option value="REJECT">Ditolak</option>
                                                </select>
                                                <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="modal fade" id="imageShow-1" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="imageShow-2" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <!-- Penawaran Terbuka -->
                    <div class="tab-pane fade" id="list-verified" role="tabpanel" aria-labelledby="list-verified-list">
                        <ul class="list-group my-3">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                    </div>
                                    <div class="col">
                                        <span class="badge bg-light">#123123</span>
                                        <h4 class="mb-2">Rompi Relawan COVID 19</h4>
                                        <div class="btn btn-success mt-2 ">Disetujui</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Proyek Dalam Pengerjaan -->
                    <div class="tab-pane fade" id="list-reject" role="tabpanel" aria-labelledby="list-reject-list">
                        <!-- TODO: Make List Item -->
                        <ul class="list-group my-3">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                    </div>
                                    <div class="col">
                                        <span class="badge bg-light">#123123</span>
                                        <h4 class="mb-2">Rompi Relawan COVID 19</h4>
                                        <div class="btn btn-danger mt-2 ">Ditolak</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('extra-js')
@endsection
