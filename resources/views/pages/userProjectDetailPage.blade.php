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
                    <div class="carousel-item active">
                        <img src="{{ asset('img/dummy-img.jpg') }}" class="rounded d-block w-100" alt="preview">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/dummy-img.jpg') }}" class="rounded d-block w-100" alt="preview">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/dummy-img.jpg') }}" class="rounded d-block w-100" alt="preview">
                    </div>
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
                <h4 class="userProjectDetail__price mb-1">Rp. 1.000.000</h4>
                <h2 class="userProjectDetail__title mb-0">Relawan Rompi COVID</h2>
                <p class="userProjectDetail__amount">Jumlah: 1000 buah</p>

                <div class="userProjectDetail__detail">
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Kategori</p>
                        <p class="userProjectDetail__category">Seragam Sekolah</p>
                    </div>
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Jumlah Penawaran</p>
                        <p class="userProjectDetail__quotation">10 penawaran</p>
                    </div>
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Alamat</p>
                        <p class="userProjectDetail__address">Jl. Jambu VI Blok S6 No.19 Sukatani Permai</p>
                    </div>
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Vendor</p>
                        <p class="userProjectDetail__vendor">Qwerty Visual</p>
                    </div>
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Mulai Pengerjaan</p>
                        <p class="userProjectDetail__startDate">10 Maret 2020</p>
                    </div>
                    
                    <div class="userProjectDetail__detail--wrapper">
                        <p class="userProjectDetail__detail--title">Selesai Pengerjaan</p>
                        <p class="userProjectDetail__endDate">20 Maret 2020</p>
                    </div>
                </div>
                <p class="userProjectDetail__detail--title">Catatan</p>
                <p class="userProjectDetail__note">Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku.Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku. Saya membutuhkan kancing dengan bahan aluminium dengan kerah yang kaku.</p>
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
