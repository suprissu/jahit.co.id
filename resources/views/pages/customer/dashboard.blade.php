@extends('layouts.base')

@section('title', 'Dashboard Customer')

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
                    <!-- TODO: For loop List Item -->

                    <!-- TODO: Modal item edit project -->
                    <div class="modal fade pl-0" id="editProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="auth-form" method="POST" action="">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <span class="badge badge-secondary">Menunggu Pembayaran</span>
                                        <h4>Penyelenggara Relawan COVID</h4>
                                        <h5 class="text-danger">Rp.1.300.000</h5>
                                        <div class="form-group">
                                            <label for="edit-project-name">Nama Proyek</label>
                                            <input placeholder="Masukkan nama proyek di sini" type="text" class="form-control" id="edit-project-name" aria-describedby="nameHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-category">Kategori</label>
                                            <select class="form-control">
                                                <option value="">Pilih opsi</option>
                                                <option value="Seragam Putih">Seragam Putih</option>
                                                <option value="Seragam Kantoran">Seragam Kantoran</option>
                                                <option value="Seragam TNI">Seragam TNI</option>
                                                <option value="Seragam Pilot">Seragam Pilot</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-order">Jumlah Pesanan</label>
                                            <input placeholder="Masukkan jumlah pesanan di sini" type="text" class="form-control" id="edit-project-order" aria-describedby="orderHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-quotation">Jumlah Penawaran</label>
                                            <input placeholder="Masukkan jumlah penawaran di sini" type="text" class="form-control" id="edit-project-quotation" aria-describedby="quotationHelp">
                                            <button class="btn btn-danger mt-1">Lihat Penawaran</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-address">Alamat</label>
                                            <input placeholder="Masukkan alamat di sini" type="text" class="form-control" id="edit-project-address" aria-describedby="addressHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-address">Vendor</label>
                                            <input placeholder="Masukkan alamat di sini" type="text" class="form-control" id="edit-project-address" aria-describedby="addressHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-startDate">Mulai Pengerjaan</label>
                                            <input placeholder="Masukkan mulai pengerjaan di sini" type="text" class="form-control" id="edit-project-startDate" aria-describedby="startDateHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-deadline">Deadline</label>
                                            <input placeholder="Masukkan deadline di sini" type="text" class="form-control" id="edit-project-deadline" aria-describedby="deadlineHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-note">Catatan</label>
                                            <textarea type="text" class="form-control" id="edit-project-note" aria-describedby="noteHelp" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-project-picture">Upload Gambar</label>
                                            <div class="upload-files__container">
                                                <div class="upload-files__wrapper">
                                                    <input class="upload-files__input" name="project_pict_path[]" id="edit-project-picture" type="file" class="form-control @error('project_pict_path.0') is-invalid @enderror" value="{{ old('project_pict_path.0') }}" aria-describedby="pictureAddon" multiple>
                                                    <label for="edit-project-picture" class="upload-files__add">Upload file</label>
                                                </div>
                                                <div class="upload-files__preview">
                                                </div>
                                            </div>
                                            @error('project_pict_path.0')
                                            <span class="invalid-feedback" role="alert">
                                                Some files might have invalid format or more than 2,5MB.
                                            </span>
                                            @enderror
                                            <small id="pictureAddon" class="form-text text-muted">Dapat pilih banyak gambar dengan menggunakan CTRL (PC) atau hold image satu per satu (HP)</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
