@extends('layouts.base')

@section('title', 'Transaction Administrator')

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
        <h3 class="mb-3">Material Administrator</h3>
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
                                        <div class="col-sm-12 col-md-4">
                                            <img class="rounded w-100" src="{{ asset('/img/dummy-img.jpg') }}" alt=""/>
                                        </div>
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#123123</span>
                                            <h4 class="mb-2">Qwerty Visual</h4>
                                            <p class="mb-2">Jumlah: 12 buah</p>
                                            <p class="mb-2">Material: Kain kasa</p>
                                            <form action="/admin/material" method="POST">
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
