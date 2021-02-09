@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/userProjectDetail.css') }}">
@endsection

@section('content')
<div class="userProjectDetail">
    <div class="userProjectDetail__container">

            <div id="preview" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner rounded">
                    @if (!empty($project->images))
                        @foreach ($project->images as $image)
                        <div class="carousel-item active">
                            <img src="{{ asset($image->path) }}" class="rounded d-block w-100" alt="preview">
                        </div>
                        @endforeach
                    @endif
                </div>
                <a class="carousel-control-prev" href="#preview" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#preview" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="userProjectDetail__wrapper">
                @if (!empty($project->cost))
                    <h4 class="userProjectDetail__price mb-1">Rp {{ number_format($project->cost, 2, ',', '.') }}</h4>
                @endif
                <h2 class="userProjectDetail__title mb-0">{{ $project->name }}</h2>
                <p class="userProjectDetail__amount">Jumlah: {{ $project->count }} buah</p>

                <div class="userProjectDetail__detail">
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Kategori</p>
                        <p class="userProjectDetail__category">{{ $project->category->name }}</p>
                    </div>
                    
                    <!-- <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Jumlah Penawaran</p>
                        <p class="userProjectDetail__quotation">10 penawaran</p>
                    </div> -->
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Alamat</p>
                        <p class="userProjectDetail__address">{{ $project->address }}</p>
                    </div>
                    
                    @if (!empty($project->partner))
                        <div class="userProjectDetail__detail--wrapper">
                            <p class="userProjectDetail__detail--title">Vendor</p>
                            <p class="userProjectDetail__vendor">{{ $project->partner->company_name }}</p>
                        </div>
                    @endif

                    @if (!empty($project->start_date))
                        <div class="userProjectDetail__detail--wrapper">
                            <p class="userProjectDetail__detail--title">Mulai Pengerjaan</p>
                            <p class="userProjectDetail__startDate">{{ $project->start_date }}</p>
                        </div>
                    @endif
                    
                    @if (!empty($project->deadline))
                        <div class="userProjectDetail__detail--wrapper">
                            <p class="userProjectDetail__detail--title">Selesai Pengerjaan</p>
                            <p class="userProjectDetail__endDate">{{ $project->deadline }}</p>
                        </div>
                    @endif

                </div>
                <p class="userProjectDetail__detail--title">Catatan</p>
                <p class="userProjectDetail__note">{{ $project->note }}</p>
            </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
$(".preview__list img").on("click", (e) => {
    console.log(e)
})
</script>
@endsection
