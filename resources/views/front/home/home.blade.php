@extends('front.layout.app')
@section('content')
<!-- Hero Section -->
<div id="carouselExampleControls" class="carousel slide space-section vh-100  w-100 " data-bs-ride="carousel">
    <div class="carousel-inner ">
        <div class="carousel-item active">
            <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100  w-100 bg-skyline"
                style="background-image: url('/images/hero-bg.svg');">
                <div class="spacer-x">
                    <h1 class="hero-title bolder-text display-4">Bantu anak kurang gizi</h1>
                    <p class="lead">Yuk Bantu anak-anak di desa mendapatkan gizi yang pantas</p>
                    <div class="text-center">
                        <button class="btn btn-primary" id="button-event" style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
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
                        <button class="btn btn-primary" id="button-event" style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
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
                        <button class="btn btn-primary" id="button-event" style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
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
                        <button class="btn btn-primary" id="button-event" style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
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
                    <span class="fw-bold">DonasiKita </span>meyakinkan Anda untuk menjadi bagian dari perubahan positif melalui platform donasi yang transparan, aman, dan terpercaya. Dengan menghubungkan donatur dengan beragam program bantuan, kami berkomitmen untuk memperkuat solidaritas sosial serta memberdayakan komunitas yang membutuhkan di seluruh Indonesia. Bersama, kita dapat menciptakan masa depan yang lebih peduli, inklusif, dan berdaya, di mana setiap kontribusi kecil membawa dampak besar bagi mereka yang membutuhkan uluran tangan kita.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End About Content Section -->

<!-- Donate Content Section -->
<section id="donate-content" class="bg-skyline space-section">
    <div class="container-fluid d-flex justify-content-center bg-skyline px-3">
        <div class="container bg-light shadow py-5 px-5 rounded-5 spacer" id="card-donate">
            <div class="row justify-content-center align-items-center">

                <div class="row d-flex justify-content-between align-items-center mb-4 px-0 mx-0">
                    <div class="col">
                        <h4>Kampanye berlangsung</h4>
                    </div>
                    <div class="col-auto">
                        <a href="" class="btn border-primary text-primary rounded-pill">Show More</a>
                    </div>
                </div>

                <div class="row">
                    <!-- Kartu pertama -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
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
                                    <div class="progress-bar progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p class="text-medium mt-2">
                                    Rp 9.550.000/ <span class="fw-bold">Rp 50.000.000</span>
                                    <br>
                                <p class="text-small">285 donatur</p>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu kedua -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
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
                                    <div class="progress-bar progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p class="text-medium mt-2">
                                    Rp 10.050.000/ <span class="fw-bold">Rp 100.000.000</span>
                                    <br>
                                <p class="text-small">598 donatur</p>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu ketiga -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
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
                                    <div class="progress-bar progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p class="text-medium mt-2">
                                    Rp 70.000.000/ <span class="fw-bold">Rp 200.000.000</span>
                                    <br>
                                <p class="text-small">1.908 donatur</p>
                                </p>
                            </div>
                        </div>
                    </div>
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
        <p class="text-dark text-large">"Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain." <br> <span class="fw-bold mt-3">-Rasulullah SAW-</span></p>
    </div>
</section>
<!-- End Quote Content Section -->

<!-- Blog Upcoming Event -->
<section id="upcoming-content" class="space-section container-fluid bg-skyline w-100 vw-100">
    <h1 class="bolder-text text-dark text-center bg-skyline">Join Our Upcoming Event</h1>
    <div class="container mx-auto bg-skyline pt-4 event-container" id="container-upcoming" style="padding: 0 !important;">
        <div class="row justify-content-center text-center py-0 my-0 gx-4" style="margin: 0 !important;">
            <!-- Kartu pertama -->
            <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4 ">
                <div class="event-card rounded rounded-5">
                    <img src="/images/event/1.svg" alt="Event Image" class="img-fluid overflow-hidden">
                    <div class="event-card-spacer">
                        <div class="event-date ms-2 mt-3">20 November</div>
                    </div>
                    <div class="event-details event-card-spacer">
                        <p class="event-title mb-3 fw-bold">Donasi untuk Palestina: Aksi Kemanusiaan</p>
                        <p class="card-text fw-thin text-extra-small mb-3 opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Literasi Nusantara
                        </p>
                        <p class="card-text  text-extra-small mb-3 opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="event-info mt-2 justify-content-between">
                            <span><i class="fa fa-clock"></i> 10:00 - 12:00</span>
                            <span><i class="fa fa-location-dot"></i> Live Streaming</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kartu kedua -->
            <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4 ">
                <div class="event-card rounded rounded-5">
                    <img src="/images/event/2.svg" alt="Event Image" class="img-fluid">
                    <div class="event-card-spacer">
                        <div class="event-date ms-2 mt-3">5 Desember</div>
                    </div>
                    <div class="event-details event-card-spacer">
                        <p class="event-title mb-3 fw-bold">Pendidikan untuk Semua: Galakan Gerakan Sosial</p>
                        <p class="card-text fw-thin text-extra-small mb-3 opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Literasi Nusantara
                        </p>
                        <p class="card-text  text-extra-small mb-3 opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="event-info mt-2 d-flex justify-content-between">
                            <span><i class="fa fa-clock"></i> 14:00 - 17:00</span>
                            <span><i class="fa fa-location-dot"></i> Jakarta (JCC)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu ketiga -->
            <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4 ">
                <div class="event-card rounded rounded-5">
                    <img src="/images/event/3.svg" alt="Event Image" class="img-fluid">
                    <div class="event-card-spacer ">
                        <div class="event-date ms-2 mt-3">15 Desember</div>
                    </div>
                    <div class="event-details event-card-spacer">
                        <p class="event-title fw-bold mb-3">Bazar Donasi Kemanusiaan: Peduli Gempa</p>
                        <p class="card-text fw-thin mb-3 text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Literasi Nusantara
                        </p>
                        <p class="card-text  text-extra-small mb-3 opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="event-info mt-2 d-flex justify-content-between">
                            <span><i class="fa fa-clock"></i> 09:00 - 17:00</span>
                            <span><i class="fa fa-location-dot"></i> GSG, Jakarta</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-center bg-skyline pt-5 py-5">
                <button class="btn btn-primary" id="button-event" style="background: rgb(33,133,187) !important; margin: 6px; font-weight: lighter;padding: 10px 20px;">
                    <h3>See More Event</h3>
                </button>
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
            <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Sukarelawan</button>
        </div>
    </div>
</section>
<!-- End Blog Invitatitation -->

<!-- Blog Content Section -->
<section id="blog-content" class="space-section">
    <div class="container mt-5">
        <h1 class="bolder-text text-dark text-center mb-5">Blog & Article</h1>
        <div class="card shadow py-5 mb-5" id="card-donate">
            <div class="row justify-content-center align-items-center">

                <div class="row d-flex justify-content-between align-items-center mb-4 px-5 mx-0">
                    <div class="col">
                        <h4>Blog terkini</h4>
                    </div>
                    <div class="col-auto">
                        <a href="" class="btn border-primary text-primary rounded-pill">Show More</a>
                    </div>
                </div>

                <div class="row w-100 gx-5">
                    <!-- Kartu pertama -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3 w-20 ">
                        <div class="card rounded overflow-hidden shadow  h-100 d-flex flex-column">
                            <img src="/images/donate/1.svg" class="card-img-top" alt="...">
                            <div class="card-body blog-details-container d-flex flex-column justify-content-between">
                                <b class="text-dark">Membangun Komunitas Peduli</b>
                                <p class="card-text text-primary text-small">
                                    Cara membangun komunitas untuk menciptakan perubahan sosial.
                                </p>
                                <div>
                                    <a href="" class="text-primary text-small">Read this article</a>
                                    <p class="text-primary text-small">04 25 Feb | Category | Author</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu kedua -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3 w-20 ">
                        <div class="card rounded overflow-hidden shadow  h-100 d-flex flex-column">
                            <img src="/images/donate/2.svg" class="card-img-top" alt="...">
                            <div class="card-body blog-details-container d-flex flex-column justify-content-between">
                                <b class="text-dark">Donasi Langsung Lebih Efektif</b>
                                <p class="card-text text-primary text-small">
                                    Kenapa donasi langsung lebih memberikan dampak nyata.
                                </p>
                                <div>
                                    <a href="" class="text-primary text-small">Read this article</a>
                                    <p class="text-primary text-small">04 25 Feb | Category | Author</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu ketiga -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3 w-20">
                        <div class="card rounded overflow-hidden shadow  h-100 d-flex flex-column">
                            <img src="/images/donate/3.svg" class="card-img-top" alt="...">
                            <div class="card-body blog-details-container d-flex flex-column justify-content-between">
                                <b class="text-dark">Alasan Melakukan Donasi</b>
                                <p class="card-text text-primary text-small">
                                    Mengapa setiap orang perlu berdonasi, bahkan sedikit.
                                </p>
                                <div>
                                    <a href="" class="text-primary text-small">Read this article</a>
                                    <p class="text-primary text-small">04 25 Feb | Category | Author</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Content Section -->
@endsection