@extends('layouts.base')

@section('title', 'Dashboard Administrator')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/adminDashboard.css') }}">
@endsection

@section('content')
<div class="admin__dashboard">
    <div class="admin__dashboard___container container">
        <h3 class="mb-3">Dashboard Administrator</h3>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="admin__dashboard__header list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-customer-list" data-toggle="list" href="#list-customer" role="tab" aria-controls="customer">Customers ({{ $customers->count() }})</a>
                        <a class="list-group-item list-group-item-action" id="list-partner-list" data-toggle="list" href="#list-partner" role="tab" aria-controls="partner">Partners ({{ $partners->count() }})</a>
                        <a class="list-group-item list-group-item-action" id="list-project-list" data-toggle="list" href="#list-project" role="tab" aria-controls="project">Projects ({{ $projects->count() }})</a>
                </div>
                <div class="admin__dashboard__list header tab-content" id="nav-tabContent">
                    
                    <!-- Semua Proyek -->
                    <div class="tab-pane fade show active" id="list-customer" role="tabpanel" aria-labelledby="list-customer-list">
                        <!-- TODO: Make List Item -->
                        @foreach ($customers->sortByDesc('created_at') as $counter=>$customer)
                            <ul class="list-group my-3">
                                <li class="list-group-item">
                                    <h4 class="mb-4">{{ $customer->user->name }}</h4>
                                    <p><strong>Email :</strong><br/> {{ $customer->user->email }}</p>
                                    <p><strong>Perusahaan :</strong><br/> {{ $customer->company_name }}</p>
                                    <p><strong>Nomor Telepon :</strong><br/> {{ $customer->phone_number }}</p>
                                    @if ($customer->user->is_active == 1)
                                        <p><strong>Status :</strong><br/> Aktif</p>
                                    @else
                                        <p><strong>Status :</strong><br/> Tidak Aktif</p>
                                    @endif
                                </li>
                                <li class="list-group-item btn btn-outline-danger" data-toggle="collapse" data-target="#order-{{ $counter }}" aria-expanded="false" aria-controls="#order-{{ $counter }}"><strong>Pesanan</strong></li>
                                <li class="list-group-item collapse" id="order-{{ $counter }}">
                                    @foreach ($customer->projects->sortByDesc('created_at') as $index => $project)
                                        <div class="card card-body my-3">
                                            <h4 class="mb-4">{{ $project->name }}</h4>
                                            <p><strong>Tanggal Order :</strong><br/> {{ $project->created_at->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <p><strong>Kategori :</strong><br/> {{ $project->category->name }}</p>
                                            <p><strong>Jumlah :</strong><br/> {{ $project->count }}</p>
                                            <p><strong>Alamat :</strong><br/> {{ $project->address }}</p>
                                            <p><strong>Catatan :</strong><br/> {{ $project->note }}</p>
                                            <p><strong>Desain :</strong><br/></p>
                                            <div class="row mx-2">
                                                @foreach ($project->images as $image)
                                                    <img class="border rounded mx-1" height="100" width="100" src="{{ asset($image->path) }}" alt="image-preview">
                                                @endforeach
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    
                    <!-- Penawaran Terbuka -->
                    <div class="tab-pane fade" id="list-partner" role="tabpanel" aria-labelledby="list-partner-list">
                        @foreach ($partners->sortByDesc('created_at') as $counter=>$partner)
                            <div class="card my-3">
                                <div class="card-body">
                                    <h4 class="mb-4">{{ $partner->user->name }}</h4>
                                    <p><strong>Email :</strong><br/> {{ $partner->user->email }}</p>
                                    <p><strong>Perusahaan :</strong><br/> {{ $partner->company_name }}</p>
                                    <p><strong>Nomor Telepon :</strong><br/> {{ $partner->phone_number }}</p>
                                    @if ($partner->user->is_active == 1)
                                        <p><strong>Status :</strong><br/> Aktif</p>
                                    @else
                                        <p><strong>Status :</strong><br/> Tidak Aktif</p>
                                    @endif
                                </div>
                                <div class="row m-2">
                                    <div class="col">
                                        <p><strong>KTP :</strong><br/></p>
                                        <img class="border rounded img-fluid img-thumbnail" src="{{ asset($partner->ktp_pict_link) }}" alt="ktp_image">
                                    </div>
                                    <div class="col">
                                        <p><strong>NPWP :</strong><br/></p>
                                        <img class="border rounded img-fluid img-thumbnail" src="{{ asset($partner->npwp_pict_link) }}" alt="npwp_image">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Proyek Dalam Pengerjaan -->
                    <div class="tab-pane fade" id="list-project" role="tabpanel" aria-labelledby="list-project-list">
                        <!-- TODO: Make List Item -->
                        <ul class="list-group my-2">
                            @foreach ($categories->sortBy('name') as $index => $category)
                                <li class="list-group-item btn btn-outline-danger" data-toggle="collapse" data-target="#order-{{ $index }}" aria-expanded="false" aria-controls="#order-{{ $index }}">
                                    <strong>{{ $category->name }} ({{ $category->projects->count() }})</strong>
                                </li>
                                <li class="list-group-item collapse" id="order-{{ $index }}">
                                    @foreach ($category->projects->sortByDesc('created_at') as $index => $project)
                                        <div class="card card-body my-3">
                                            <h4 class="mb-4">{{ $project->name }}</h4>
                                            <p><strong>Tanggal Order :</strong><br/> {{ $project->created_at->formatLocalized('%A, %d %B %Y [%H:%I]') }}</p>
                                            <p><strong>Kategori :</strong><br/> {{ $project->category->name }}</p>
                                            <p><strong>Jumlah :</strong><br/> {{ $project->count }}</p>
                                            <p><strong>Alamat :</strong><br/> {{ $project->address }}</p>
                                            <p><strong>Catatan :</strong><br/> {{ $project->note }}</p>
                                            <p><strong>Desain :</strong><br/></p>
                                            <div class="row mx-2">
                                                @foreach ($project->images as $image)
                                                    <img class="border rounded mx-1" height="100" width="100" src="{{ asset($image->path) }}" alt="image-preview">
                                                @endforeach
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <h3>{{ $categories->count() }} Categories</h3>
                <div class="list-group">
                    @foreach ($categories->sortBy('name') as $index => $category)
                        <div class="list-group-item btn btn-outline-dark">{{ $category->name }} ({{ $category->projects->count() }})</div>
                    @endforeach
                </div>
            </div>
        </div>
</div>
@endsection

@section('extra-js')

@endsection
