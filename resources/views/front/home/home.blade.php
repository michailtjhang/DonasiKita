@extends('front.layout.app')
<style>
    .accordion-button::after {
        content: '';
        display: inline-block;
        width: 3.5rem !important;
        height: 3.5rem !important;
        background-image: url('/images/button_faq.svg') !important;
        /* Path ke ikon Anda */
        background-size: 100% !important;
        background-repeat: no-repeat;
        background-position: center;
        transition: transform 0.3s ease;
    }

    /* Rotasi ketika accordion dibuka */
    .accordion-button:not(.collapsed)::after {
        transform: rotate(90deg) !important;
    }

    .accordion-rounded {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .accordion-header {

        border-radius: 30px !important;
    }

    /* Styling tambahan */
    .accordion-button {
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .accordion-button:focus,
    .accordion-button:not(.collapsed) {
        background-color: transparent !important;
        /* Pastikan tidak berubah saat fokus atau aktif */
        color: inherit !important;
        /* Warna teks tetap */
        box-shadow: none !important;
        /* Hilangkan efek outline */
    }

    .accordion-body-custom {
        background-color: #f8fcff;
        color: #0f3d56;
        /* border: 1px solid #0f3d56;
    border-radius: 5px; */
    }

    .accordion-teks-custom {
        color: #0f3d56 !important;
    }

    /* .accordion-button:hover {
    color: #084298;
} */
</style>
@section('content')
    <!-- Hero Section -->
    <div id="carouselExampleControls" class="carousel slide space-section" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                    style="background-image: url('/images/hero-bg.svg');">
                    <div class="spacer-x">
                        <h1 class="hero-title bolder-text display-4">Bantu anak kurang gizi</h1>
                        <p class="lead">Yuk Bantu anak-anak di desa mendapatkan gizi yang pantas</p>
                        <div class="text-center">
                            <button class="btn btn-primary" id="button-event"
                                style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                                <h3>Bantu Sekarang</h3>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item =">
                <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                    style="background-image: url('/images/hero/2.svg');">
                    <div class="spacer-x">
                        <h1 class="hero-title bolder-text display-4">Darutat Gunung Lewotobi</h1>
                        <p class="lead">Bersama membantu korban yang terdampak bencana alam ini</p>
                        <div class="text-center">
                            <button class="btn btn-primary" id="button-event"
                                style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                                <h3>Bantu Sekarang</h3>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                    style="background-image: url('/images/hero/3.svg');">
                    <div class="spacer-x">
                        <h1 class="hero-title bolder-text display-4">Banjir di Desa Rawajaya</h1>
                        <p class="lead">Ayo tolong Bencana yang disebabkan limpasan air dari sungai Jakadenda</p>
                        <div class="text-center">
                            <button class="btn btn-primary" id="button-event"
                                style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                                <h3>Bantu Sekarang</h3>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                    style="background-image: url('/images/hero/4.svg');">
                    <div class="spacer-x">
                        <h1 class="hero-title bolder-text display-4">Tanah Longsor di Desa Kertajaya</h1>
                        <p class="lead">Ayo buat transportasi lancar dari tanah longsor yang menimpa jalan</p>
                        <div class="text-center">
                            <button class="btn btn-primary" id="button-event"
                                style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                                <h3>Bantu Sekarang</h3>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Hero Section -->
    <!-- About Content Section -->
    <section id="about-content" class="space-section">
        <div class="container-fluid py-5 justify-content-center text-center bg-skyline">
            <h1 class="bolder-text text-dark" style="margin-bottom: 50px"> Kamu Adalah Harapan Lainnya</h1>
            <div class="row mx-auto text-wrap" style="width:80%;">
                <div class="col-lg-6 col-12">
                    <img src="/images/content/about.svg" class="about-image img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-12 text-dark d-flex  px-5">
                    <p style="font-size: 26px; text-align:left">
                        <span class="fw-bold">DonasiKita </span>meyakinkan Anda untuk menjadi bagian dari perubahan positif
                        melalui platform donasi yang transparan, aman, dan terpercaya. Dengan menghubungkan donatur dengan
                        beragam program bantuan, kami berkomitmen untuk memperkuat solidaritas sosial serta memberdayakan
                        komunitas yang membutuhkan di seluruh Indonesia. Bersama, kita dapat menciptakan masa depan yang
                        lebih peduli, inklusif, dan berdaya, di mana setiap kontribusi kecil membawa dampak besar bagi
                        mereka yang membutuhkan uluran tangan kita.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Content Section -->

    <!-- Donate Content Section -->
    <section id="donate-content" class="bg-skyline space-section">
        <div class="container d-flex justify-content-center bg-skyline ">

            <div class="row  justify-content-center align-items-center">
                <div class="row mx-2">
                    <h3 class="fw-bold">Donation</h3>
                    <div class="d-flex flex-wrap align-items-center pb-2">
                        <!-- Paragraf -->
                        <p class="text-muted mb-2 flex-grow-1 col-12 col-lg-11">
                            Berikan harapan, wujudkan perubahan. Mari berbagi kebaikan hari ini!
                        </p>
                        <!-- Tombol -->
                        <a href="{{ route('donations') }}" class="btn rounded rounded-5 fw-light col-4  col-lg-1"
                            style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">
                            See More
                        </a>
                    </div>
                </div>

                <div class="row ">

                    @foreach ($last_donations as $item)
                        <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                            <a href="{{ route('donations.show', $item->slug) }}">
                                <div class="card rounded rounded-5 overflow-hidden shadow card-item">
                                    @if ($item->thumbnail && $item->thumbnail->file_path)
                                        <img src="{{ $item->thumbnail->file_path }}" class="card-img-top" alt="..."
                                            style="object-fit: cover !important;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                            style="height: 160px;">
                                            <span>No cover image</span>
                                        </div>
                                    @endif
                                    <div class="card-body px-4">
                                        <p class="card-text">{{ $item->title }}</p>
                                        <p class="text-dark mb-2">
                                            <i class="fa fa-user"></i>
                                            {{ $item->towards ?? 'Anonim' }}
                                        </p>
                                        <p class="text-primary text-small mb-0">
                                            Target
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar progress-bar-animated" role="progressbar"
                                                style="width: {{ (str_replace(['Rp', '.', ','], '', $item->donation->sum('amount')) / intval(str_replace(['Rp', '.', ','], '', $item->target_amount))) * 100 }}%;"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        </p>
                                        <p class="text-medium mt-2">
                                            Rp {{ number_format($item->donation->sum('amount'), 0, ',', '.') }}/ <span
                                                class="fw-bold">Rp
                                                {{ number_format($item->target_amount, 0, ',', '.') }}</span>
                                            <br>
                                        <p class="text-small">{{ $item->donation->count() }} donatur</p>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </section>
    <!-- End Donate Content Section -->

    <!-- Quote Content Section -->
    <section id="quote-content" class="space-section">
        <div class="container-fluid d-flex justify-content-center align-items-center text-center bg-skyline"
            style="background-image: url('/images/quotes.svg'); height: 400px; background-size: cover; background-position: center; background-repeat: no-repeat;">
            <p class="text-light m-0" style="font-size: 35px; text-shadow: 2px 2px #000;">
                "Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain." <br>
                <span class="fw-bold mt-3">-Rasulullah SAW-</span>
            </p>
        </div>
    </section>

    <!-- End Quote Content Section -->

    <!-- Blog Upcoming Event -->
    <section id="upcoming-content" class="space-section container-fluid bg-skyline w-100">
        <div class="container">
            <div class="row justify-content-between align-items-center mx-auto">
                <div class="col-6 d-flex justify-content-start">
                    <h1 class="bolder-text text-dark text-start">Join Our Upcoming Event</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{ route('events') }}" class="btn rounded rounded-5 fw-light" id="button-event"
                        style="border: 2px solid #1a3a4f; color: #1a3a4f;padding: 10px 20px;">
                        See More
                    </a>
                </div>
            </div>
        </div>



        <div class="container mx-auto bg-skyline pt-4 event-container" id="container-upcoming"
            style="padding: 0 !important;">
            <div class="row justify-content-center text-center py-0 my-0 gx-4" style="margin: 0 !important;">

                @foreach ($last_events as $item)
                    <div class="col-md-6 col-lg-4 col-12 d-flex justify-content-center mt-4 ">
                        <a href="{{ route('events.show', $item->slug) }}" class="text-light"
                            href="{{ url('/detail_event') }}">
                            <div class="event-card rounded rounded-5">
                                @if ($item->thumbnail && $item->thumbnail->file_path)
                                    <img src="{{ $item->thumbnail->file_path }}" alt="{{ $item->title }}"
                                        class="img-fluid overflow-hidden" style="height: 450px !important;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                        style="height: 450px;">
                                        <span>No cover image</span>
                                    </div>
                                @endif
                                <div class="">
                                    <div class="event-date">{{ $item->detailEvent->start->format('d M Y') }}</div>
                                </div>

                                <div class="event-details event-card-spacer">
                                    <p class="event-title mb-3 fw-bold">{{ $item->title }}</p>
                                    <div class="event-info d-flex card-desc mb-3 justify-content-between">
                                        <span><i class="fa fa-clock"></i> {{ $item->detailEvent->start->format('H:i') }} -
                                            {{ $item->detailEvent->end->format('H:i') }}</span>
                                        <span><i class="fa fa-location-dot"></i>
                                            {{ $item->location->name_location }}</span>
                                    </div>
                                    <p class="card-text card-desc  fw-thin text-extra-small mb-3  p-0 m-0">
                                        {{ $item->detailEvent->start->format('d M Y') }} | <a href="#"
                                            class="text-decoration-none text-light">{{ $item->category->name }}</a>
                                        |
                                        {{ $item->user->name ?? 'Anonim' }}
                                    </p>
                                    <p class="card-text  text-extra-small  card-desc  small">
                                        {{ Str::limit(strip_tags($item->description), 100, '...') }}
                                    </p>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Blog Upcoming Event -->

    <!-- Blog Invitatitation -->
    <section id="blog-invitation" class="space-section">
        <div class="banner py-0 w-100">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <h1 style="font-size: 60px;">Your help means a lot</h1>
                <p style="font-size: 41px;">donate or be a volunteer now!</p>
                <button class="btn btn-custom" id="button-event" style="font-size: 30px;">Donate</button>
                <a href="{{ url('/event') }}">
                    <button class="btn btn-custom" id="button-event" style="font-size: 30px;">Sukarelawan</button>
                </a>
            </div>
        </div>
    </section>
    <!-- End Blog Invitatitation -->

    <!-- Blog Content Section -->
    <section id="blog-content" class="space-section">
        <div class="container">
            <h1 class="bolder-text text-dark text-center ">Blog & Article</h1>
            <div class="pb-5 mb-5" id="card-donate">
                <div class="row justify-content-center align-items-center">
                    <div class="row mx-2">
                        <h3 class="fw-bold">Blog & Article</h3>
                        <div class="d-flex flex-wrap align-items-center pb-2">
                            <!-- Paragraf -->
                            <p class="text-muted mb-2 flex-grow-1 col-12 col-lg-11">
                                Jelajahi kisah inspiratif dan info seputar event donasi. Baca sekarang dan beri dukungan.
                            </p>
                            <!-- Tombol -->
                            <a href="{{ route('blog') }}" class="btn rounded rounded-5  fw-light col-4 col-lg-1"
                                style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">
                                See More
                            </a>
                        </div>
                    </div>


                    <div class="row">
                        @foreach ($last_articles as $item)
                            <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3  ">
                                <div class="card rounded rounded-5 overflow-hidden shadow w-100 d-flex flex-column">
                                    {{-- acuan img blog --}}
                                    @if ($item->thumbnail && $item->thumbnail->file_path)
                                        <a href="{{ route('blog.show', $item->slug) }}">
                                            <img src="{{ $item->thumbnail->file_path }}"
                                                class="card-img-top img-fluid blog-img" alt="{{ $item->title }}"
                                                style="height: 200px !important;">
                                        </a>
                                    @else
                                        <a href="{{ route('blog.show', $item->slug) }}">
                                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                                style="height: 200px;">
                                                <span>No cover image</span>
                                            </div>
                                        </a>
                                    @endif
                                    <div
                                        class="card-body blog-details-container d-flex flex-column justify-content-between px-4">
                                        <b class="text-dark">{{ $item->title }}</b>
                                        <p class="card-text text-primary text-small mt-3">
                                            {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                        </p>
                                        <div class="text-primary text-small">

                                            {{ $item->created_at->format('d M Y') }} | {{ $item->category->name }}
                                            | {{ $item->user->name ?? 'Anonim' }}</p>
                                        </div>
                                        <div class="d-flex w-100">
                                            <a href="{{ route('blog.show', $item->slug) }}" class="btn blog-btn w-100">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Content Section -->

    <!-- FAQ Content Section -->
    <section id="accodrion" class="space-section">
        <h1 class="bolder-text text-dark text-center mb-5 ">Frequently Asked Question</h1>
        <div class="container">
            <div class="row">
                <!-- Kolom Kiri: Gambar -->
                <div class="col-lg-6 col-12 d-flex justify-content-center mb-5">
                    <img src="{{ url('/images/faq.svg') }}" alt="" class="img img-fluid">
                </div>
                <!-- Kolom Kanan: Accordion -->
                <div class="col-lg-6 col-12 p-4">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item accordion-rounded   mb-3">
                            <h2 class="accordion-header accordion-rounded" id="headingOne">
                                <button class="accordion-button fw-bold collapsed fw-bold accordion-teks-custom"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    <span style="color: #0f3d56">Apa itu DonasiKita?</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse  accordion-body-custom collapse"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body ">
                                    <span style="color: #0f3d56">DonasiKita adalah platform digital yang memudahkan siapa
                                        saja untuk berdonasi dan berkontribusi dalam berbagai proyek kemanusiaan, seperti
                                        pendidikan, kesehatan, bencana alam, dan lainnya.</span>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item accordion-rounded   mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Bagaimana cara membuat akun di DonasiKita?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <span style="color: #0f3d56">Klik tombol "Daftar," isi data pribadi Anda, dan ikuti
                                        langkah-langkah pendaftaran yang sederhana.</span>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item accordion-rounded   mb-3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Bagaimana cara berdonasi di DonasiKita?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <span style="color: #0f3d56">Anda bisa memilih proyek yang ingin didukung, klik tombol
                                        "Donasi Sekarang," masukkan jumlah donasi, dan pilih metode pembayaran yang
                                        tersedia.</span>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item accordion-rounded   mb-3">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Apakah ada batas minimum untuk berdonasi?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <span style="color: #0f3d56">Ya, batas minimum donasi adalah Rp10.000 untuk memudahkan
                                        semua orang berpartisipasi.</span>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item accordion-rounded   mb-3">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    Apakah DonasiKita aman?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <span style="color: #0f3d56">DonasiKita menggunakan sistem keamanan yang terpercaya dan
                                        memastikan setiap donasi tercatat serta disalurkan sesuai tujuan. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Content Section -->
@endsection
