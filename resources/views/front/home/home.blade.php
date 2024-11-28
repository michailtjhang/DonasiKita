@extends('front.layout.app')
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
            <div class="carousel-item">
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
            <h1 class="bolder-text text-dark">Kamu Adalah Harapan Lainnya</h1>
            <div class="row mx-auto text-wrap" style="width:80%;">
                <div class="col-lg-6 col-12">
                    <img src="/images/content/about.svg" class="about-image img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-12 text-dark d-flex align-items-center px-5">
                    <p>
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
                        <button class="btn rounded rounded-5 fw-light col-4  col-lg-1"
                            style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">
                            See More
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- Kartu pertama -->

                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <a href="{{ url('/detail_donation') }}">
                            <div class="card rounded rounded-5 overflow-hidden shadow card-item">
                                <img src="/images/donate/1.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Bantu Pendidikan Anak Pedalaman.</p>
                                    <p class="text-dark mb-2">
                                        <i class="fa fa-user"></i>
                                        Yayasan Anak Nusantara
                                    </p>
                                    <p class="text-primary text-small mb-0">
                                        Target
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar progress-bar-animated" role="progressbar"
                                            style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    </p>
                                    <p class="text-medium mt-2">
                                        Rp 9.550.000/ <span class="fw-bold">Rp 50.000.000</span>
                                        <br>
                                    <p class="text-small">285 donatur</p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Kartu kedua -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <a href="{{ url('/detail_donation') }}">
                            <div class="card rounded rounded-5 overflow-hidden shadow card-item">
                                <img src="/images/donate/2.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Aksi Bencana Alam untuk Korban Gempa</p>
                                    <p class="text-dark mb-2">
                                        <i class="fa fa-user"></i>
                                        Komunitas Peduli Sesama
                                    </p>
                                    <p class="text-primary text-small mb-0">
                                        Target
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar progress-bar-animated" role="progressbar"
                                            style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    </p>
                                    <p class="text-medium mt-2">
                                        Rp 10.050.000/ <span class="fw-bold">Rp 100.000.000</span>
                                        <br>
                                    <p class="text-small">598 donatur</p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Kartu ketiga -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <a href="{{ url('/detail_donation') }}">
                            <div class="card rounded rounded-5 overflow-hidden shadow card-item">
                                <img src="/images/donate/3.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Bantuan Kemanusiaan untuk Palestina</p>
                                    <p class="text-dark mb-2">
                                        <i class="fa fa-user"></i>
                                        Yayasan Peduli Palestina
                                    </p>
                                    <p class="text-primary text-small mb-0">
                                        Target
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar progress-bar-animated" role="progressbar"
                                            style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    </p>
                                    <p class="text-medium mt-2">
                                        Rp 70.000.000/ <span class="fw-bold">Rp 200.000.000</span>
                                        <br>
                                    <p class="text-small">1.908 donatur</p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- End Donate Content Section -->

    <!-- Quote Content Section -->
    <section id="quote-content" class="space-section">
        <div class="container-fluid py-5 justify-content-center text-center bg-skyline spacer-x">
            <h1 class="bolder-text text-dark mb-3">Qoutes</h1>
            <p class="text-dark text-large">"Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain." <br> <span
                    class="fw-bold mt-3">-Rasulullah SAW-</span></p>
        </div>
    </section>
    <!-- End Quote Content Section -->

    <!-- Blog Upcoming Event -->
    <section id="upcoming-content" class="space-section container-fluid bg-skyline w-100">
        <h1 class="bolder-text text-dark text-center bg-skyline">Join Our Upcoming Event</h1>
        <div class="container mx-auto bg-skyline pt-4 event-container" id="container-upcoming"
            style="padding: 0 !important;">
            <div class="row justify-content-center text-center py-0 my-0 gx-4" style="margin: 0 !important;">

                @foreach ($last_events as $item)
                    <div class="col-md-6 col-lg-4 col-12 d-flex justify-content-center mt-4 ">
                        <a href="{{ route('events.show', $item->slug) }}" class="text-light" href="{{ url('/detail_event') }}">
                            <div class="event-card rounded rounded-5">
                                <img src="{{ asset('storage/cover/' . $item->thumbnail->file_path) }}" alt="{{ $item->title }}" class="img-fluid overflow-hidden">
                                <div class="">
                                    <div class="event-date">{{ $item->detailEvent->start->format('d M Y') }}</div>
                                </div>
                                <div class="event-details event-card-spacer">
                                    <p class="event-title mb-3 fw-bold">{{ $item->title }}</p>
                                    <p class="card-text fw-thin text-extra-small mb-3 opacity-75 p-0 m-0">
                                        {{ $item->detailEvent->start->format('d M Y') }} | <a href="#" class="text-decoration-none text-light">{{ $item->category->name }}</a>
                                        |
                                        {{ $item->user->name ?? 'Anonim' }}
                                    </p>
                                    <p class="card-text  text-extra-small mb-3 opacity-75 small">
                                        {{ Str::limit(strip_tags($item->description), 100, '...') }}
                                    </p>
                                    <div class="event-info justify-content-between">
                                        <span><i class="fa fa-clock"></i> {{ $item->detailEvent->start->format('H:i') }} - {{ $item->detailEvent->end->format('H:i') }}</span>
                                        <span><i class="fa fa-location-dot"></i> {{ $item->location->name_location }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="text-center bg-skyline pt-5 py-5">
                    <a href="{{ route('events') }}">
                        <button class="btn btn-primary" id="button-event"
                            style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                            <h3>See More Event</h3>
                        </button>
                    </a>
                </div>
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
                <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Donate</button>
                <a href="{{ url('/event') }}">
                    <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Sukarelawan</button>
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
                        @foreach ($popular_articles as $item)
                            <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3  ">
                                <a href="{{ route('blog.show', $item->slug) }}">
                                    <div class="card rounded rounded-5 overflow-hidden shadow  h-100 d-flex flex-column">
                                        <img src="{{ asset('storage/cover/' . $item->thumbnail->file_path) }}"
                                            class="card-img-top" alt="{{ $item->title }}">
                                        <div
                                            class="card-body blog-details-container d-flex flex-column justify-content-between">
                                            <b class="text-dark">{{ $item->title }}</b>
                                            <p class="card-text text-primary text-small">
                                                {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                            </p>
                                            <div>
                                                <a href="{{ route('blog.show', $item->slug) }}"
                                                    class="text-primary text-small">Read this article</a>
                                                <p class="text-primary text-small">
                                                    {{ $item->created_at->format('d M Y') }} | {{ $item->category->name }}
                                                    | {{ $item->user->name ?? 'Anonim' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Content Section -->
@endsection
