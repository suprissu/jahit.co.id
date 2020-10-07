@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')

@endsection

@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>Hi! I'm {{ $role }}</h1>
    
    <hr>
    <h3>{{ $customers->count() }} Customers</h3>
    <div class="ml-5">
    @foreach ($customers as $counter=>$customer)
        <hr>
        <div>[{{ $counter + 1 }}] {{ $customer->user->name }}</div>
        <div>Email : {{ $customer->user->email }}</div>
        <div>Perusahaan : {{ $customer->company_name }}</div>
        <div>Nomor Telepon : {{ $customer->phone_number }}</div>
        @if ($customer->user->is_active == 1)
            <div>Status : Aktif</div>
        @else
            <div>Status : Tidak Aktif</div>
        @endif
        <div>Pesanan :</div>
        <div class="ml-5">
        @foreach ($customer->projects as $index => $project)
            <hr>
            <div>[{{ $index + 1 }}] {{ $project->name }}</div>
            <div>Kategori : {{ $project->category->name }}</div>
            <div>Jumlah : {{ $project->count }}</div>
            <div>Alamat : {{ $project->address }}</div>
            <div>Catatan : {{ $project->note }}</div>
            <div>Desain :</div>
            @foreach ($project->images as $image)
                <img width="100px" src="{{ asset($image->path) }}">
            @endforeach
            <br>
        @endforeach
        <br>
        </div>
    @endforeach
    </div>
    
    <hr>
    <h3>{{ $partners->count() }} Partners</h3>
    <div class="ml-5">
    @foreach ($partners as $counter=>$partner)
        <hr>
        <div>[{{ $counter + 1 }}] {{ $partner->user->name }}</div>
        <div>Email : {{ $partner->user->email }}</div>
        <div>Perusahaan : {{ $partner->company_name }}</div>
        <div>Nomor Telepon : {{ $partner->phone_number }}</div>
        @if ($partner->user->is_active == 1)
            <div>Status : Aktif</div>
        @else
            <div>Status : Tidak Aktif</div>
        @endif
        <div>KTP :</div>
        <img width="100px" src="{{ asset($partner->ktp_pict_link) }}">
        <div>NPWP :</div>
        <img width="100px" src="{{ asset($partner->npwp_pict_link) }}">
    @endforeach
    </div>
    
    <hr>
    <h3>{{ $projects->count() }} Projects</h3>
    <div class="ml-5">
        @foreach ($projects as $index => $project)
            <hr>
            <div>[{{ $index + 1 }}] {{ $project->name }}</div>
            <div>Kategori : {{ $project->category->name }}</div>
            <div>Jumlah : {{ $project->count }}</div>
            <div>Alamat : {{ $project->address }}</div>
            <div>Catatan : {{ $project->note }}</div>
            <div>Desain :</div>
            @foreach ($project->images as $image)
                <img width="100px" src="{{ asset($image->path) }}">
            @endforeach
            <br>
        @endforeach
    </div>

    <hr>
    <h3>{{ $categories->count() }} Categories</h3>
    <div class="ml-5">
        @foreach ($categories as $index => $category)
            <hr>
            <div>[{{ $index + 1 }}] {{ $category->name}}</div>
        @endforeach
    </div>
@endsection

@section('extra-js')

@endsection
