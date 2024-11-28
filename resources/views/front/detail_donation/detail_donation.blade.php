@extends('front.layout.app')
@section('style')
<style>
    .list-unstyled li {
        position: relative;
        padding-left: 1.5rem;
        /* Ruang untuk penanda titik */
        margin-bottom: 1rem;
    }

    .list-unstyled strong {
        position: relative;
    }

    .list-unstyled strong::before {
        content: '•';
        /* Penanda titik */
        position: absolute;
        left: -1.5rem;
        /* Tempatkan di kiri elemen */
        color: #000;
        /* Warna titik */
        font-size: 1.4rem;
        /* Ukuran titik */
        line-height: 1.5;
        /* Menyamakan tinggi dengan teks */
    }

    .spacing-donation p {
        line-height: 2;
    }

    /* about page */
    .leader-image {
        width: 25%;
    }

    .team-slider .card {
        border: none;
        border-radius: 10px;
        background-color: transparent;
    }

    .team-slider .card-body {
        text-align: center;
    }

    .carousel-control-prev {
        top: 50%;
        transform: translateY(-50%);
        left: -40px;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }

    .carousel-control-next {
        top: 50%;
        transform: translateY(-50%);
        right: -40px;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }

    .team-slider .carousel-control-prev-icon,
    .team-slider .carousel-control-next-icon {
        font-size: 1.2rem;
        color: #fff;
    }

    /* responsive */
    @media (max-width: 576px) {
        .text-heading-donation {
            font-size: 18px;
            /* Cocok untuk layar HP kecil */
        }
    }

    @media (max-width: 768px) {
        .text-heading-donation {
            font-size: 24px;
            /* Cocok untuk layar tablet atau HP besar */
        }
    }

    @media (max-width: 992px) {
        .text-heading-donation {
            font-size: 30px;
            /* Cocok untuk layar laptop kecil */
        }
    }
</style>
@endsection
@section('content')
<!-- Hero Section -->
<section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
    <div class="hero-overlay2"></div>
    <div class="hero-content2 text-left px-5 ms-5">
        <h1 class="hero-title2">Detail Donation</h1>
        <p class="hero-subtitle2">Donation Bantuan Kemanusiaan untuk Palestina</p>
    </div>
</section>
<!-- End Hero Section -->

<section id="detail-donation" class="container my-5 pt-5">
    <div class="card shadow rounded-4">
        <div class="container pt-5 px-lg-5 px-md-4 px-3 mt-lg-4" style="padding-left: 2.225rem !important; padding-right: 2.225rem !important;">
            <!-- Gambar -->
            <img src="/images/donate/3.svg" alt="Donation Image" class="card-img-top img-fluid rounded">

            <!-- Konten -->
            <div class="py-4">
                <p class=" fw-bold h1">Bantuan Kemanusiaan untuk Palestina</p>
                <!-- Target dan Total -->
                <div class="row pt-4 align-items-center">
                    <div class="col-6">
                        <p
                            class="fw-bold text-dark text-nowrap m-0"
                            style="font-size: clamp(1rem, 1.5vw, 1.75rem);">
                            Target
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <p
                            class="fw-bold text-dark text-nowrap m-0"
                            style="font-size: clamp(1rem, 1.5vw, 1.75rem);">
                            Rp 200.000.000
                        </p>
                    </div>
                </div>



                <!-- Progress Bar -->
                <div class="progress my-3 rounded" style="height: 22px;  background-color: #bbddf0 !important;">
                    <div class="progress-bar progress-bar-animated rounded-5" role="progressbar" style="width: 40%;  background-color:#50a8d7 !important" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <!-- Terkumpul dan Donatur -->
                <div class="row mt-2">
                    <div class="col-6">
                        <p
                            class="mb-0 fw-light text-nowrap h3"
                            style="color: #145071 !important; font-size: clamp(0.7rem, 1.5vw, 2rem);">
                            Terkumpul: Rp 70.000.000
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <p
                            class="mb-0 text-nowrap h3"
                            style="color: #145071 !important; font-size: clamp(0.7rem, 1.5vw, 2rem);">
                            <strong>1,908</strong> Donatur
                        </p>
                    </div>
                </div>


                <!-- Yayasan -->
                <div class="py-4">
                    <h1 class="fw-light text-heading-donation" style="color: #0f3d56;">
                        <i class="fa-solid fa-user "></i> Yayasan Peduli Palestina
                    </h1>
                </div>

                <!-- Deskripsi -->
                <div class="container">
                    <div class="border rounded p-4">
                        <p class="h4">
                            Warga Palestina saat ini menghadapi kondisi kemanusiaan yang sangat memprihatinkan, dengan terbatasnya akses terhadap kebutuhan dasar sehari-hari. Krisis yang terus berlangsung telah mempengaruhi banyak keluarga yang kehilangan tempat tinggal, akses kesehatan, dan kebutuhan dasar mereka. Melalui kampanye ini, kami mengajak Anda untuk bersama-sama meringankan beban mereka. Setiap donasi yang Anda berikan akan langsung disalurkan untuk memenuhi kebutuhan esensial warga Palestina, sehingga mereka dapat bertahan dalam situasi yang sulit ini.
                        </p>
                    </div>
                </div>


                <!-- Goals -->
                <h6 class="fw-bold mt-4 h3">What They Needed (Goals)</h6>
                <div class="container-fluid">
                    <div class="border rounded p-4">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong class="fw-bold h4">Paket Pangan</strong>
                                <p class="h4" style="line-height: 2.0;">Pangan menjadi kebutuhan utama bagi warga Palestina yang kehilangan sumber penghasilan. Bantuan ini mencakup sembako seperti beras, minyak goreng, makanan kaleng, susu untuk anak-anak, dan kebutuhan gizi lainnya, yang diharapkan dapat menopang kesehatan mereka.</p>
                            </li>
                            <li class="mb-3">
                                <strong class="fw-bold h4">Obat-obatan dan Peralatan Medis</strong>
                                <p class="h4" style="line-height: 2.0;">Banyak warga Palestina yang memerlukan obat-obatan mendesak dan perawatan kesehatan. Donasi akan digunakan untuk membeli obat-obatan dasar, seperti antibiotik, vitamin, dan peralatan medis penting lainnya untuk merawat mereka yang terluka atau sakit. Kami juga akan membantu memenuhi kebutuhan di fasilitas kesehatan yang kekurangan persediaan.</p>
                            </li>
                            <li class="mb-3">
                                <strong class="fw-bold h4">Perlengkapan Kebersihan dan Sanitasi</strong>
                                <p class="h4" style="line-height: 2.0;">Kebersihan dan kesehatan sangat penting dalam situasi darurat. Kami menyediakan sabun, hand sanitizer, masker, dan kebutuhan kebersihan lainnya.</p>
                            </li>
                            <li>
                                <strong class="fw-bold h4">Air Bersih dan Sanitasi</strong>
                                <p class="h4" style="line-height: 2.0;">Air bersih adalah kebutuhan dasar yang sering sulit diakses. Bantuan akan digunakan untuk menyediakan air minum bersih dan fasilitas sanitasi.</p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Button Share and Donate -->
<div class="container my-5">
    <div class="row justify-content-between">
        <!-- Share Button -->
        <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0 mb-lg-0 ">
            <button class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center " style="background-color: #bbddf0;">
                <h1 class="d-flex align-items-center mb-0" style="font-size: 1.5rem; color: #0f3d56;">
                    <i class="fas fa-share-alt me-2"></i> Share
                </h1>
            </button>
        </div>
        <!-- Donate Now Button -->
        <div class="col-12 col-md-8 d-flex justify-content-center">
            <button class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center" id="donateNowBtn">
                <h1 class="mb-0" style="font-size: 1.5rem;">Donate Now</h1>
            </button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.getElementById('donateNowBtn').addEventListener('click', () => {
        Swal.fire({
            title: '<strong>Gabung Sebagai</strong>',
            html: `
        <button id="pesertaBtn" style="width: 100%; margin: 5px 0; padding: 10px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px;">
            Donasi Barang
        </button>
        <button id="sukarelawanBtn" style="width: 100%; margin: 5px 0; padding: 10px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px;">
            Donasi Uang
        </button>
        `,
            showConfirmButton: false,
            customClass: {
                popup: 'custom-swal-popup'
            },
            // didOpen: () => {
            // // Event listener untuk tombol Peserta
            // document.getElementById('pesertaBtn').addEventListener('click', () => {
            //     Swal.fire('Anda Berhasil Mendonasikan Barang!');
            // });

            // // Event listener untuk tombol Sukarelawan
            // document.getElementById('sukarelawanBtn').addEventListener('click', () => {
            //     Swal.fire('Anda Berhasil Mendonasikan Uang!');
            // });
            // }
        });
    });
</script>

@endsection