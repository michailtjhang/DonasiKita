@extends('front.layout.app')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .search-container {
            width: 50%;
            padding: 0 15px;
        }

        .event-card-spacer-short {
            padding-bottom: 18px !important;
        }

        /* Search bar styling */
        .search-box {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 100%;
            max-width: 1200px;
            /* Panjang maksimal (sesuai ukuran laptop) */
            min-width: 300px;
            /* Panjang minimal */
            max-height: 400px;

        }

        /* Input styling */
        .search-box input {
            border: none;
            outline: none;
            padding: 15px 20px;
            border-radius: 50px 0 0 50px;
            flex: 1;
            font-size: 16px;
        }

        /* Tombol pencarian */
        .search-box .search-btn {
            background-color: #4ca3dd;
            /* Warna biru */
            color: #fff;
            border: none;
            border-radius: 0 50px 50px 0;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-box .search-btn:hover {
            background-color: #3b8fc4;
            /* Warna biru lebih gelap saat hover */
        }

        .search-box .search-btn i {
            font-size: 20px;
        }

        /* Paginasi Container */
        /* Paginasi Container */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            gap: 10px;
        }

        /* Tombol Panah */
        .pagination-arrow {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 50%;
            background-color: #bbddf0;
            color: #0f3d56;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination-arrow:hover {
            background-color: #a9cce3;
        }

        /* Titik-titik Paginasi */
        .pagination-dots {
            display: flex;
            gap: 8px;
        }

        .pagination-dot {
            width: 10px;
            height: 10px;
            background-color: #d4e6f1;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination-dot.active {
            background-color: #3498db;
        }

        .pagination-dot:hover {
            background-color: #85c1e9;
        }

        .page-item .page-link {
            color: #007bff;
            /* Warna biru */
            font-size: 18px;
            /* Ukuran font */
            border: none;
            background: none;
        }

        .page-item .page-link.active {
            background-color: transparent;
            font-weight: bold;
        }

        .page-link-dot {
            font-size: 24px;
            /* Membuat titik lebih besar */
            line-height: 1;
            color: #007bff;
            pointer-events: none;
            /* Nonaktifkan klik pada titik */
        }

        .page-item .page-link:hover {
            text-decoration: none;
        }

        .page-link[aria-label="Previous"],
        .page-link[aria-label="Next"] {
            font-size: 20px;
            /* Panah lebih besar */
        }

        .event-card {
            position: relative;
            overflow: hidden;
            height: 500px;
            width: 100%;
            min-width: 240px;
            /* Menambahkan minimum width 200px */
            max-width: 350px;
            /* Menjaga lebar tidak lebih dari 350px */
            padding: 0;
            box-sizing: border-box;
            margin: 0 auto;
        }

        .gap-35 {
            gap: 17.5px !important;
        }

        /* Gaya umum untuk scrollbar */
        ::-webkit-scrollbar {
            height: 10px;
            /* Tinggi scrollbar horizontal */
            width: 10px;
            /* Lebar scrollbar vertikal */
            background: #e8f5fc;
            /* Warna latar belakang scrollbar */
            border-radius: 10px;
        }

        /* Track scrollbar */
        ::-webkit-scrollbar-track {
            background: #bbddf0;
            /* Warna trek */
            border-radius: 10px;
        }

        /* Handle scrollbar */
        ::-webkit-scrollbar-thumb {
            background: #6ab7e9;
            /* Warna pegangan */
            border-radius: 10px;
        }

        /* Hover effect untuk scrollbar */
        ::-webkit-scrollbar-thumb:hover {
            background: #4ca6d6;
            /* Warna pegangan saat dihover */
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 768px) {
            .search-box {
                max-width: 90%;
                /* Ukuran maksimal pada layar kecil */
            }
        }

        @media (max-width: 480px) {
            .search-box {
                max-width: 100%;
                /* Full width untuk layar sangat kecil */
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">Event</h1>
            <p class="hero-subtitle2-event">Telusuri berbagai acara inspiratif yang mendukung misi kemanusiaan.<br>Setiap
                partisipasi Anda adalah langkah kecil menuju perubahan besar.</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Search Bar -->
    <section id="search-bar"
        style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
        <div class="search-container d-flex justify-content-center align-items-center">
            <div class="search-box">
                <input type="text" class="form-control" placeholder="ingin cari event apa hari ini?">
                <button class="btn search-btn" type="button">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </section>
    <!-- End Search Bar -->

    <!-- Followed Event -->
    <section id="folowed-event" class="container-fluid spacer-x pt-2" style="padding-bottom: 100px">
        <div class="row justify-content-center  px-2  mx-2 ">
            <h2 class="fw-bold">Event yang Diikuti</h2>
            <p class="text-muted">Selesaikan Event untuk membantu saudara kita.</p>

            <!-- Container untuk card -->
            <div class="card-container d-flex gap-35 p-25" style="overflow-x: auto; scroll-snap-type: x mandatory; ">
                <!-- Card 1 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4 "
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-1.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            28 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Donasi Buku untuk Pendidikan</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Literasi
                            Nusantara
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 08:00 - 15:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Surabaya, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-2.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            02 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Konser Musik untuk Harapan</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            10 Feb 25 | <a href="#" class="text-decoration-none">Hiburan</a> | Author
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short ">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 18:00 - 22:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Jakarta, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-3.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            10 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Pameran Seni Amal</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            01 Jan 25 | <a href="#" class="text-decoration-none">Hiburan</a> | Yayasan Seni Peduli
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 08:00 - 15:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Surabaya, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                {{-- <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="./images/event/followed-event-4.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                        15 Maret
                    </div>
                </div>
                <div class="event-details">
                    <p class="card-title fw-bold h4">Penggalangan Dana Virtual: Game Marathon</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        08 Feb 25 | <a href="#" class="text-decoration-none">Hiburan</a> | Komunitas Gamer Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 18:00 - 06:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Online (Zoom)
                        </div>
                    </div>
                </div>
            </div> --}}

                <!-- Card 5 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event//followed-event-4.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            21 Januari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Donor Darah Massal</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            20 Jan 25 | <a href="#" class="text-decoration-none">Kesehatan</a> | Palang Merah
                            Indonesia
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 08:00 - 021:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Yogyakarta, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-5.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            28 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Konser Amal untuk Anak Yatim</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Sosial</a> | Komunitas Musik Peduli
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 18:00 - 21:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Yogyakarta, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-6.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            05 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Bazar Buku untuk Pendidikan</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Buku Cerdas
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 10:00 - 19:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan Card 4, 5, dst dengan format serupa -->
            </div>
        </div>
    </section>
    <!-- End Followed Event -->

    <!-- History Event -->
    <section id="history-event" class="container-fluid spacer-x pt-2" style="padding-bottom: 100px">
        <div class="row justify-content-center  px-2  mx-2 ">
            <h2 class="fw-bold">History yang pernah di ikuti</h2>
            <p class="text-muted">Semua progress anda akan disimpan dan menjadi langkah untuk mengubah dunia.</p>

            <!-- Container untuk card -->
            <div class="card-container d-flex gap-3" style="overflow-x: auto; scroll-snap-type: x mandatory;">
                <!-- Card 1 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/history-event-1.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            15 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Penggalangan Dana Virtual: Game Marathon</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            08 Feb 25 | <a href="#" class="text-decoration-none">Hiburan</a> | Komunitas Gamer
                            Peduli
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 18:00 - 06:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Online (Zoom)
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Card 2 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/history-event-2.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            10 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Pelatihan Relawan Bencana</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Relawan
                            Nusantara
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 09:00 - 15:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Bogor, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/history-event-3.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            30 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Seminar Bisnis Sosial</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            10 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Inspirasi
                            Bisnis
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 09:00 - 13:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Aula Inovasi, Surabaya
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/history-event-4.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            24 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Workshop Pemberdayaan UMKM</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            02 Jan 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Lembaga Bisnis
                            Mandiri
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 09:00 - 16:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Coworking Space, Bali
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event//history-event-4.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            18 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Lomba Lari 5k untuk Kesehatan</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            15 Jan 25 | <a href="#" class="text-decoration-none">Kesehatan</a> | Komunitas Sehat
                            Bersama
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 06:00 - 09:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/history-event-5.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            10 Februari
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Pameran Seni Amal</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            01 Jan 25 | <a href="#" class="text-decoration-none">Seni</a> | Yayasan Seni Peduli
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 10:00 - 18:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Galeri Nasional, Jakarta
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                    style="scroll-snap-align: start; width: 300px;">
                    <div class="position-relative">
                        <img src="./images/event/followed-event-6.svg" class="card-img-top" alt="Donasi Buku">
                        <div class="date-label position-absolute top-0 start-0 bg-primary text-white mx-3 mt-3 event-date">
                            05 Maret
                        </div>
                    </div>
                    <div class="event-details">
                        <p class="card-title fw-bold h4">Bazar Buku untuk Pendidikan</p>
                        <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                            04 Feb 25 | <a href="#" class="text-decoration-none">Edukasi</a> | Yayasan Buku Cerdas
                        </p>
                        <p class="card-text text-extra-small opacity-75 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                        </p>
                        <div class="card-text text-extra-small d-flex justify-content-between event-card-spacer-short">
                            <div class="col-md-6">
                                <i class="fa-solid fa-clock"></i> 10:00 - 19:00 <br>
                            </div>
                            <div class="col-md-6">
                                <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan Card 4, 5, dst dengan format serupa -->
            </div>
        </div>
    </section>
    <!-- End HistoryEvent -->

    <!-- Kategori Event -->
    <div class="container-fluid spacer-x pt-2">
        <div class="row justify-content-center  px-2  mx-2 ">
            <h2 class="fw-bold">Jelajahi dan Ikuti Beragam Acara Kebaikan</h2>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="text-muted mb-0">Temukan berbagai event menarik yang mendukung misi kemanusiaan.</p>
                <a href="{{ route('categories') }}" class="btn rounded rounded-5 hover-bg-primary hover-text-white"
                    style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">See All Categories</a>
            </div>



            <!-- Wadah kartu -->
            <div id="card-container" class="row d-flex justify-content-center">
                @forelse ($events as $event)
                    <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4">
                        <div class="event-card rounded rounded-5">
                            <!-- Thumbnail -->
                            @if ($event->thumbnail && $event->thumbnail->file_path)
                                <img src="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}"
                                    alt="{{ $event->title }}" class="img-fluid overflow-hidden">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                    style="height: 200px;">
                                    <p class="text-muted">Thumbnail Tidak Tersedia</p>
                                </div>
                            @endif

                            <!-- Date -->
                            <div class="event-card-spacer">
                                <div class="event-date ms-2 mt-3">
                                    {{ $event->detailEvent->start->format('d M Y') ?? 'TBA' }}
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="event-details event-card-spacer">
                                <!-- Title -->
                                <p class="event-title fw-bold">{{ $event->title }}</p>

                                <!-- Metadata -->
                                <p class="card-text fw-thin text-extra-small mb-3 opacity-75 p-0 m-0">
                                    {{ $event->category->name ?? 'Uncategorized' }} |
                                    {{ $event->organizer ?? 'Anonymous' }}
                                </p>

                                <!-- Description -->
                                <p class="card-text text-extra-small mb-3 opacity-75 small">
                                    {{ Str::limit(strip_tags($event->description), 100, '...') }}
                                </p>

                                <!-- Time and Location -->
                                <div class="event-info mt-2 d-flex justify-content-between event-card-spacer-short">
                                    <span><i class="fa fa-clock"></i> {{ $event->detailEvent->start->format('H:i') }} -
                                        {{ $event->detailEvent->end->format('H:i') }}</span>
                                    <span><i class="fa fa-location-dot"></i>
                                        {{ $event->location->name_location ?? 'TBA' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-4">No events found.</p>
                @endforelse
            </div>

            <!-- Navigasi Slider -->
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links() }}
            </div>

        </div>
    </div>


    <!-- End Kategori Event -->
@endsection


@section('script')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script>
        // Data Kartu
        const cardsData = [{
                date: "20 November",
                title: "Donasi untuk Palestina",
                category: "Edukasi",
                organizer: "Yayasan Literasi Nusantara",
                time: "10:00 - 12:00",
                location: "Live Streaming",
                img: "/images/event/1.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "5 Desember",
                title: "Pendidikan untuk Semua: Galakan Gerakan Sosial",
                category: "Sosial",
                organizer: "KitaBisa",
                time: "14:00 - 16:00",
                location: "Gedung A",
                img: "/images/event/2.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "15 Desember",
                title: "Aksi Lingkungan",
                category: "Lingkungan",
                organizer: "Hijau Bersama",
                time: "09:00 - 11:00",
                location: "Taman Kota",
                img: "/images/event/3.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "15 Januari",
                title: "Festival Seni untuk Amal",
                category: "Seni dan Budaya",
                organizer: "Komunitas Kreatif Nusantara",
                time: "14:00 - 21:00",
                location: "Jakarta, Indonesia",
                img: "/images/event/4.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "27 Februari",
                title: "Workshop Kemanusiaan",
                category: "Edukasi",
                organizer: "Komunitas Belajar",
                time: "15:00 - 17:00",
                location: "Online Zoom",
                img: "/images/event/5.svg",
                month: "10 Jan 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "12 Maret",
                title: "Donor Darah",
                category: "Kesehatan",
                organizer: "Palang Merah",
                time: "08:00 - 12:00",
                location: "Rumah Sakit",
                img: "/images/event/6.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "20 November",
                title: "Donasi untuk Palestina",
                category: "Edukasi",
                organizer: "Yayasan Literasi Nusantara",
                time: "10:00 - 12:00",
                location: "Live Streaming",
                img: "/images/event/1.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "5 Desember",
                title: "Peduli Bencana Alam",
                category: "Kesehatan",
                organizer: "Bantu Sesama",
                time: "14:00 - 16:00",
                location: "Gedung A",
                img: "/images/event/2.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "15 Desember",
                title: "Aksi Lingkungan",
                category: "Lingkungan",
                organizer: "Hijau Bersama",
                time: "09:00 - 11:00",
                location: "Taman Kota",
                img: "/images/event/3.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "5 Januari",
                title: "Bazar Amal",
                category: "Sosial",
                organizer: "Amal Foundation",
                time: "10:00 - 13:00",
                location: "Lapangan ABC",
                img: "/images/event/4.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "27 Februari",
                title: "Workshop Kemanusiaan",
                category: "Edukasi",
                organizer: "Komunitas Belajar",
                time: "15:00 - 17:00",
                location: "Online Zoom",
                img: "/images/event/5.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
            {
                date: "12 Maret",
                title: "Donor Darah",
                category: "Kesehatan",
                organizer: "Palang Merah",
                time: "08:00 - 12:00",
                location: "Rumah Sakit",
                img: "/images/event/6.svg",
                month: "10 nov 25",
                body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed..."
            },
        ];

        // Variabel Halaman
        let currentPage = 1;
        const cardsPerPage = 6;

        // Fungsi untuk Menampilkan Kartu
        function renderCards(page) {
            const startIndex = (page - 1) * cardsPerPage;
            const visibleCards = cardsData.slice(startIndex, startIndex + cardsPerPage);

            const cardContainer = document.getElementById("card-container");
            cardContainer.innerHTML = ""; // Bersihkan kontainer

            visibleCards.forEach((card) => {
                cardContainer.innerHTML += `
                <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4 " >
                    <div class="event-card rounded rounded-5">
                        <img src="${card.img}" alt="Event Image" class="img-fluid overflow-hidden">
                    <div class="event-card-spacer">
                        <div class="event-date ms-2 mt-3">${card.date}</div>
                    </div>
                        <div class="event-details  event-card-spacer">
                            <p class="event-title fw-bold">${card.title}</p>
                            <p class="card-text fw-thin text-extra-small mb-3 opacity-75 p-0 m-0" >
                            ${card.month} | <a href="#" class="text-decoration-none">${card.category}</a> | ${card.organizer}
                            </p>
                            <p class="card-text  text-extra-small mb-3 opacity-75 small" >
                                ${card.body}
                            </p>
                            <div class="event-info mt-2 d-flex justify-content-between event-card-spacer-short">
                                <span><i class="fa fa-clock"></i> ${card.time}</span>
                                <span><i class="fa fa-location-dot"></i> ${card.location}</span>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
        }

        // Fungsi untuk Membuat Titik-Titik Paginasi
        function createPaginationDots() {
            const dotsContainer = document.getElementById("pagination-dots");
            dotsContainer.innerHTML = ""; // Bersihkan elemen lama

            for (let i = 1; i <= Math.ceil(cardsData.length / cardsPerPage); i++) {
                const dot = document.createElement("div");
                dot.classList.add("pagination-dot");
                if (i === currentPage) dot.classList.add("active");
                dot.addEventListener("click", () => {
                    currentPage = i;
                    updatePagination();
                });
                dotsContainer.appendChild(dot);
            }
        }

        // Fungsi untuk Memperbarui Halaman
        function updatePagination() {
            renderCards(currentPage); // Render kartu
            createPaginationDots(); // Perbarui navigasi titik
        }

        // Event Listener untuk Tombol Panah
        document.getElementById("prev-page").addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        });

        document.getElementById("next-page").addEventListener("click", () => {
            if (currentPage < Math.ceil(cardsData.length / cardsPerPage)) {
                currentPage++;
                updatePagination();
            }
        });

        // Inisialisasi
        updatePagination();
    </script>
@endsection
