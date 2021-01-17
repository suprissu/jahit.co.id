@extends('layouts.base')

@section('title', 'Material Request')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/tabular.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
@inject('materialRequestStatusConstant', 'App\Constant\MaterialRequestStatusConstant')

<div class="tabular">
    <div class="tabular___container container">
        <h3 class="mb-3">Material Administrator</h3>
        <div class="row">
            <div class="col">
                <div class="tabular__header list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-waiting-list" data-toggle="list" href="#list-waiting" role="tab" aria-controls="waiting">Menunggu Verifikasi</a>
                        <a class="list-group-item list-group-item-action" id="list-accept-list" data-toggle="list" href="#list-accept" role="tab" aria-controls="approved">Disetujui</a>
                        <a class="list-group-item list-group-item-action" id="list-sent-list" data-toggle="list" href="#list-sent" role="tab" aria-controls="sent">Dikirim</a>
                        <a class="list-group-item list-group-item-action" id="list-reject-list" data-toggle="list" href="#list-reject" role="tab" aria-controls="rejected">Ditolak</a>
                </div>
                <div class="tabular__list header tab-content" id="nav-tabContent">
                    
                    <!-- Semua Proyek -->
                    <div class="tab-pane fade show active" id="list-waiting" role="tabpanel" aria-labelledby="list-waiting-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $requestsRequested as $project )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#{{ $project->id }}</span>
                                            <h4 class="mb-2">{{ $project->name }}</h4>
                                            <p class="mb-2">Jumlah: {{ $project->materialRequests->count() }} Pesanan</p>
                                            <h5 class="mb-2">Material</h5>
                                            @foreach ( $project->materialRequests as $index => $materialRequest )
                                                @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED)
                                                    <p class="mb-2">{{ $index + 1 }}. @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '(' . $materialRequest->status . ')' }}</i></span></p>
                                                    <p class="listItem__material__description">[{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }}] {{ $materialRequest->note }}</p>
                                                    <form action="{{ route('home.administrator.verification.material.request') }}" method="POST">
                                                    @csrf
                                                        <input name="materialRequestID" value="{{ $materialRequest->id }}" class="materialRequest-id" type="text" style="display: none;" required>
                                                        <select class="form-control" id="role-option" name="status" required>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED ) selected="selected" @endif value="WAITING">Diajukan</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED ) selected="selected" @endif value="SENT">Dikirim</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                                    </form>
                                                    <br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    
                    <!-- Penawaran Terbuka -->
                    <div class="tab-pane fade" id="list-accept" role="tabpanel" aria-labelledby="list-accept-list">
                        @foreach( $requestsApproved as $project )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#{{ $project->id }}</span>
                                            <h4 class="mb-2">{{ $project->name }}</h4>
                                            <p class="mb-2">Jumlah: {{ $project->materialRequests->count() }} Pesanan</p>
                                            <h5 class="mb-2">Material</h5>
                                            @foreach ( $project->materialRequests as $index => $materialRequest )
                                                @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED)
                                                    <p class="mb-2">{{ $index + 1 }}. @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '(' . $materialRequest->status . ')' }}</i></span></p>
                                                    <p class="listItem__material__description">[{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }}] {{ $materialRequest->note }}</p>
                                                    <form action="{{ route('home.administrator.verification.material.request') }}" method="POST">
                                                    @csrf
                                                        <input name="materialRequestID" value="{{ $materialRequest->id }}" class="materialRequest-id" type="text" style="display: none;" required>
                                                        <select class="form-control" id="role-option" name="status" required>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED ) selected="selected" @endif value="WAITING">Diajukan</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED ) selected="selected" @endif value="SENT">Dikirim</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                                    </form>
                                                    <br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    
                    <!-- Proyek Dalam Pengerjaan -->
                    <div class="tab-pane fade" id="list-sent" role="tabpanel" aria-labelledby="list-sent-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $requestsSent as $project )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#{{ $project->id }}</span>
                                            <h4 class="mb-2">{{ $project->name }}</h4>
                                            <p class="mb-2">Jumlah: {{ $project->materialRequests->count() }} Pesanan</p>
                                            <h5 class="mb-2">Material</h5>
                                            @foreach ( $project->materialRequests as $index => $materialRequest )
                                                @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT)
                                                    <p class="mb-2">{{ $index + 1 }}. @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '(' . $materialRequest->status . ')' }}</i></span></p>
                                                    <p class="listItem__material__description">[{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }}] {{ $materialRequest->note }}</p>
                                                    <form action="{{ route('home.administrator.verification.material.request') }}" method="POST">
                                                    @csrf
                                                        <input name="materialRequestID" value="{{ $materialRequest->id }}" class="materialRequest-id" type="text" style="display: none;" required>
                                                        <select class="form-control" id="role-option" name="status" required>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED ) selected="selected" @endif value="WAITING">Diajukan</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED ) selected="selected" @endif value="SENT">Dikirim</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                                    </form>
                                                    <br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="list-reject" role="tabpanel" aria-labelledby="list-reject-list">
                        <!-- TODO: Make List Item -->
                        @foreach( $requestsRejected as $project )
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col mt-2">
                                            <span class="badge bg-light">#{{ $project->id }}</span>
                                            <h4 class="mb-2">{{ $project->name }}</h4>
                                            <p class="mb-2">Jumlah: {{ $project->materialRequests->count() }} Pesanan</p>
                                            <h5 class="mb-2">Material</h5>
                                            @foreach ( $project->materialRequests as $index => $materialRequest )
                                                @if ( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED)
                                                    <p class="mb-2">{{ $index + 1 }}. @if ($materialRequest->additional_info != null) {{ $materialRequest->additional_info }} @else {{ $materialRequest->material->name }} @endif <span class="listItem__price"><i>{{ '(' . $materialRequest->status . ')' }}</i></span></p>
                                                    <p class="listItem__material__description">[{{ $materialRequest->quantity }} {{ $materialRequest->material->metric }}] {{ $materialRequest->note }}</p>
                                                    <form action="{{ route('home.administrator.verification.material.request') }}" method="POST">
                                                    @csrf
                                                        <input name="materialRequestID" value="{{ $materialRequest->id }}" class="materialRequest-id" type="text" style="display: none;" required>
                                                        <select class="form-control" id="role-option" name="status" required>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REQUESTED ) selected="selected" @endif value="WAITING">Diajukan</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_APPROVED ) selected="selected" @endif value="ACCEPT">Disetujui</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_REJECTED ) selected="selected" @endif value="SENT">Dikirim</option>
                                                            <option @if( $materialRequest->status == $materialRequestStatusConstant::MATERIAL_SENT ) selected="selected" @endif value="REJECT">Ditolak</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-danger mt-2 float-right">Kirim</button>
                                                    </form>
                                                    <br>
                                                @endif
                                            @endforeach
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
