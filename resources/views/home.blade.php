@extends('front.layout.navigator')
@section('content')
<!-- Hero Section -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                style="background-image: url('/images/hero-bg.svg');">
                <div>
                    <h1 class="hero-title bolder-text display-4">Charity Platform</h1>
                    <p class="lead">Berbagi, Berkontribusi, Berubah</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-section d-flex align-items-center justify-content-center text-center vh-100 bg-skyline"
                style="background-image: url('/images/hero-bg.svg');">
                <div>
                    <h1 class="hero-title bolder-text display-4">Charity Platform</h1>
                    <p class="lead">Berbagi, Berkontribusi, Berubah</p>
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
<section id="about-content">
    <div class="container-fluid py-5 justify-content-center text-center bg-skyline">
        <h1 class="bolder-text text-dark">Kamu Adalah Harapan Lainnya</h1>
        <div class="row mx-auto text-wrap" style="width:80%;">
            <div class="col-lg-6 col-12">
                <img src="/images/content/about.svg" class="about-image img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-12 text-dark d-flex align-items-center px-5">
                Lorem ipsum dolor sit amet consectetur. Volutpat proin id turpis eu neque sit etiam nec quisque. Cras quam dignissim blandit metus laoreet mi ut. Eget diam volutpat ultrices massa morbi sed nibh. Sodales diam eu etiam eu quam nisl viverra. Eget egestas orci felis nisl. Sit diam morbi amet viverra auctor nunc. Feugiat ac amet aliquet euismod ut vel. Mi lectus nisl augue commodo vitae nisi blandit. Venenatis netus suscipit tempus fringilla varius feugiat nulla proin.
            </div>
        </div>
    </div>
</section>
<!-- End About Content Section -->

<!-- Donate Content Section -->
<section id="donate-content" class="bg-skyline">
    <div class="container-fluid d-flex justify-content-center bg-skyline px-3 mx-3">
        <div class="container bg-light shadow py-5 px-5 rounded-5 mx-5 " id="card-donate">
            <div class="row mx-auto text-wrap align-items-center justify-content-center">

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
                        <div class="card rounded rounded-5 overflow-hidden shadow" style="width: 18rem;">
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
                        <div class="card rounded rounded-5 overflow-hidden shadow" style="width: 18rem;">
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
                        <div class="card rounded rounded-5 overflow-hidden shadow" style="width: 18rem;">
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
<section id="quote-content">
    <div class="container-fluid py-5 justify-content-center text-center bg-skyline">
        <h1 class="bolder-text text-dark"><i class="fa-solid fa-quote-right"></i></h1>
        <p class="text-dark text-large">"Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain." <br> <span class="fw-bold">-Rasulullah SAW-</span></p>
    </div>
</section>
<!-- End Quote Content Section -->

<!-- Blog Upcoming Event -->
<section id="upcoming-content" class="text-center container-fluid bg-skyline w-100 vw-100" style="width: 100%;">
    <h1 class="bolder-text text-dark text-center bg-skyline py-0 my-0">Join Our Upcoming Event</h1>
    <div class="container-fluid justify-content-center text-center bg-skyline pt-4" id="container-upcoming">
        <div class="row mx-auto text-wrap align-items-center justify-content-center text-center">

            <!-- Kartu pertama -->
            <div class="col-md-3 mt-4 mx-3 ">
                <div class="event-card rounded rounded-5  ">
                    <img src="/images/event/1.svg" alt="Event Image" class="img-fluid overflow-hidden">
                    <div class="event-date">20 November</div>
                    <div class="event-details">
                        <p class="event-title fw-bold">Donasi untuk Palestina: Aksi Kemanusiaan</p>
                        <div class="event-info d-flex justify-content-between">
                            <span><i class="fa fa-clock"></i> 10:00 - 12:00</span>
                            <span><i class="fa fa-location-dot"></i> Live Streaming</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu kedua -->
            <div class="col-md-3 mt-4 mx-3">
                <div class="event-card rounded rounded-5">
                    <img src="/images/event/2.svg" alt="Event Image" class="img-fluid">
                    <div class="event-date">5 Desember</div>
                    <div class="event-details">
                        <p class="event-title fw-bold">Pendidikan untuk Semua: Galakan Gerakan Sosial</p>
                        <div class="event-info d-flex justify-content-between">
                            <span><i class="fa fa-clock"></i> 14:00 - 17:00</span>
                            <span><i class="fa fa-location-dot"></i> Jakarta (JCC)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu ketiga -->
            <div class="col-md-3 mt-4 mx-3">
                <div class="event-card rounded rounded-5">
                    <img src="/images/event/3.svg" alt="Event Image" class="img-fluid">
                    <div class="event-date">15 Desember</div>
                    <div class="event-details text-start">
                        <p class="event-title fw-bold text-start">Bazar Donasi Kemanusiaan: Peduli Gempa</p>
                        <div class="event-info d-flex justify-content-between">
                            <span><i class="fa fa-clock"></i> 09:00 - 17:00</span>
                            <span><i class="fa fa-location-dot"></i> GSG, Jakarta</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="text-center bg-skyline pt-5 py-5">
        <button class="btn btn-primary" id="button-event">
            <h3>See More Event</h3>
        </button>
    </div>

</section>
<!-- End Blog Upcoming Event -->

<!-- Blog Invitatitation -->
<section id="invitation-content" class="py-0 my-0 container-fluid ">
    <div class="banner py-0">
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
<section id="blog-content">
    <div class="container-fluid justify-content-center bg-skyline px-3 mx-3 py-5">
        <h1 class="bolder-text text-dark text-center">Blog & Article</h1>
        <div class="container shadow py-5 px-5 mx-5 bg-light " id="card-donate">
            <div class="row mx-auto text-wrap align-items-center justify-content-center">

                <div class="row d-flex justify-content-between align-items-center mb-4 px-0 mx-0">
                    <div class="col">
                        <h4>Blog terkini</h4>
                    </div>
                    <div class="col-auto">
                        <a href="" class="btn border-primary text-primary rounded-pill">Show More</a>
                    </div>
                </div>

                <div class="row">
                    <!-- Kartu pertama -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card rounded overflow-hidden shadow" style="width: 18rem;">
                            <img src="/images/donate/1.svg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <b class="text-dark">Membangun Komunitas Peduli</b>
                                <p class="card-text text-primary text-small">Cara membangun komunitas untuk menciptakan perubahan sosial.</p>
                                <a href="" class="text-primary text-small">Read this article</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu kedua -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card rounded overflow-hidden shadow" style="width: 18rem;">
                            <img src="/images/donate/2.svg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <b class="text-dark">Donasi Langsung Lebih Efektif</b>
                                <p class="card-text text-primary text-small">Kenapa donasi langsung lebih memberikan dampak nyata.</p>
                                <a href="" class="text-primary text-small">Read this article</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu ketiga -->
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card rounded overflow-hidden shadow" style="width: 18rem;">
                            <img src="/images/donate/3.svg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <b class="text-dark">Alasan Melakukan Donasi</b>
                                <p class="card-text text-primary text-small">Mengapa setiap orang perlu berdonasi, bahkan sedikit.</p>
                                <a href="" class="text-primary text-small">Read this article</a>
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