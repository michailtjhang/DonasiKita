@extends('front.layout.navigator')

@section('style')
<link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    .swiper {
        width: 100%;
        padding: 20px 0;
    }

    .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 15px;
    }

    .swiper-pagination-bullet {
        background: #6CB6DE !important;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #6CB6DE !important;
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
    <div class="hero-overlay2"></div>
    <div class="hero-content2 text-left px-5 ms-5">
        <h1 class="hero-title2">Donation</h1>
        <p class="hero-subtitle2">Salurkan bantuan anda, dengan menyumbang mulai dari Rp1000</p>
    </div>
</section>
<!-- End Hero Section -->

<!-- Search Bar -->
<div class="container my-4">
    <div class="Searchbar d-flex align-items-center mx-auto shadow" style="width: 600px; height: 50px; background: white; border-radius: 25px; overflow: hidden; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">
        <input type="text" class="form-control border-0" placeholder="Ingin bantu siapa hari ini?" style="font-size: 16px; color: #B3B3B3; outline: none; box-shadow: none; height: 100%; flex: 1; padding-left: 20px;">
        <div class="search-icon-container" style="background: #6CB6DE; width: 90px; height: 100%; border-top-right-radius: 25px; border-bottom-right-radius: 25px; display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/donate/Vector.svg') }}" alt="Search Icon" style="width: 20px; height: 20px;">
        </div>
    </div>
</div>

<!-- Donation Slider -->
<section id="donation-slider" class="my-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Bergabung dalam Gerakan Kebaikan</h2>
        <p class="section-subtitle text-center text-muted mb-5">Ribuan donatur telah membantu, sekarang giliran Anda untuk membuat perbedaan nyata.</p>
        <div class="swiper">
            <div class="swiper-wrapper">
                <!-- Card 1 -->
                <div class="swiper-slide">
                    <div class="card donation-card shadow-sm">
                        <img src="/images/donate/1.svg" class="card-img-top rounded-top" alt="Donation Image">
                        <div class="card-body">
                            <h5 class="card-title">Bantu Pendidikan Anak Pedalaman</h5>
                            <p class="card-text text-muted">Yayasan Anak Nusantara</p>
                            <div class="progress my-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text"><strong>Rp 25.000.000</strong> / Rp 50.000.000</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">200 Donatur</small>
                                <small class="text-muted">30 Hari Lagi</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="swiper-slide">
                    <div class="card donation-card shadow-sm">
                        <img src="/images/donate/2.svg" class="card-img-top rounded-top" alt="Donation Image">
                        <div class="card-body">
                            <h5 class="card-title">Renovasi Masjid di Pelosok Negeri</h5>
                            <p class="card-text text-muted">Yayasan Cahaya Iman</p>
                            <div class="progress my-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text"><strong>Rp 37.500.000</strong> / Rp 50.000.000</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">90 Donatur</small>
                                <small class="text-muted">20 Hari Lagi</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="swiper-slide">
                    <div class="card donation-card shadow-sm">
                        <img src="/images/donate/3.svg" class="card-img-top rounded-top" alt="Donation Image">
                        <div class="card-body">
                            <h5 class="card-title">Aksi Bencana Alam</h5>
                            <p class="card-text text-muted">Komunitas Peduli Sesama</p>
                            <div class="progress my-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text"><strong>Rp 30.000.000</strong> / Rp 50.000.000</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">150 Donatur</small>
                                <small class="text-muted">40 Hari Lagi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination and Navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
<!-- End Donation Slider -->

@endsection

@section('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            }
        }
    });
</script>
@endsection
