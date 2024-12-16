@extends('front.layout.app')

@section('seoMeta')
    <!-- Meta tags for SEO -->
    <meta name="description"
        content="{{ Str::limit(strip_tags($donation->content), 150, '...') }}">
    <meta name="keywords"
        content="{{ $keywords }}">
    <meta name="author" content="{{ config('app.name', 'DonasiKita') }} Team">

    <!-- Open Graph Meta Tags for social media sharing -->
    <meta property="og:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
    <meta property="og:description"
        content="{{ Str::limit(strip_tags($donation->description), 150, '...') }}">
    <meta property="og:image" content="{{ $donation->thumbnail->file_path ?? asset('images/logo-navbar.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
    <meta name="twitter:description"
        content="{{ Str::limit(strip_tags($donation->description), 150, '...') }}">
    <meta name="twitter:image" content="{{ $donation->thumbnail->file_path ?? asset('images/logo-navbar.svg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Additional Meta Tags -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
@endsection

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

        #shareNowBtn:hover {
            background-color: #6cb6de !important;
        }

        .social-links {
            margin: 0;
            padding: 0;
            margin-top: 10px;
            list-style-type: none;
            display: inline-block;
        }

        .social-links li {
            display: inline-block;
            margin-right: 50px;
        }

        .social-links li:last-child {
            margin-right: 0;
        }

        .social-links a {
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            background-color: var(--dark-color);
            font-size: 22px;
            color: var(--light-color);
            text-align: center;
            border-radius: 5px;
        }

        .social-links a:hover {
            color: var(--dark-color);
            background-color: var(--aqua-color);
        }

        /* responsive */
        @media (max-width: 576px) {
            .text-heading-donation {
                font-size: 16px;
                /* Cocok untuk layar HP kecil */
            }
        }

        @media (max-width: 768px) {
            .text-heading-donation {
                font-size: 20px;
                /* Cocok untuk layar tablet atau HP besar */
            }
        }

        @media (max-width: 992px) {
            .text-heading-donation {
                font-size: 24px;
                /* Cocok untuk layar laptop kecil */
            }
        }
    </style>
@endsection

@section('content')
    <div class="space-section"></div>

    <section id="detail-donation" class="container my-5 pt-5">
        <div class="card shadow rounded-4">
            <div class="container pt-5 px-lg-5 px-md-4 px-3 mt-lg-4"
                style="padding-left: 2.225rem !important; padding-right: 2.225rem !important;">

                <div class="py-4">
                    <p class=" fw-bold h1">{{ $donation->title }}</p>

                    <!-- Gambar -->
                    @if ($donation->thumbnail && $donation->thumbnail->file_path)
                        <img src="{{ $donation->thumbnail->file_path }}" class="card-img-top img-fluid rounded"
                            alt="{{ $donation->title }}">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                            style="height: 200px;">
                            <span>No cover image</span>
                        </div>
                    @endif

                    <!-- Konten -->
                    <!-- Target dan Total -->
                    <div class="row pt-4 align-items-center">
                        <div class="col-6">
                            <p class="fw-bold text-dark text-nowrap m-0" style="font-size: clamp(1rem, 1.5vw, 1.75rem);">
                                Target
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="fw-bold text-dark text-nowrap m-0" style="font-size: clamp(1rem, 1.5vw, 1.75rem);">
                                Rp. {{ number_format($donation->target_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>



                    <!-- Progress Bar -->
                    <div class="progress my-3 rounded" style="height: 22px;  background-color: #bbddf0 !important;">
                        <div class="progress-bar progress-bar-animated rounded-5" role="progressbar"
                            style="width: {{ (str_replace(['Rp', '.', ','], '', $amoutDonated) / intval(str_replace(['Rp', '.', ','], '', $donation->target_amount))) * 100 }}%;  background-color:#50a8d7 !important"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <!-- Terkumpul dan Donatur -->
                    <div class="row mt-2">
                        <div class="col-6">
                            <p class="mb-0 fw-light text-nowrap h3"
                                style="color: #145071 !important; font-size: clamp(0.7rem, 1.5vw, 2rem);">
                                Terkumpul: Rp {{ number_format($amoutDonated, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0 text-nowrap h3"
                                style="color: #145071 !important; font-size: clamp(0.7rem, 1.5vw, 2rem);">
                                <strong>{{ $donatorCount }}</strong> Donatur
                            </p>
                        </div>
                    </div>


                    <!-- Yayasan -->
                    <div class="py-4">
                        <h1 class="fw-light text-heading-donation fs-2" style="color: #0f3d56;">
                            <i class="fa-solid fa-user "></i> {{ $donation->towards }}
                        </h1>
                    </div>

                    <!-- Deskripsi -->
                    <div class="">
                        <div class="">
                            <p class="h4">
                                {{ $donation->description }}
                            </p>
                        </div>
                    </div>


                    <!-- Goals -->
                    <h6 class="fw-bold mt-4 h3">What They Needed (Goals)</h6>
                    <div class="">
                        <div class="">
                            {!! $donation->description_need !!}
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
                <button class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center "
                    style="background-color: #bbddf0;" id="shareNowBtn">
                    <h1 class="d-flex align-items-center mb-0" style="font-size: 1.5rem; color: #0f3d56;">
                        <i class="fas fa-share-alt me-2"></i> Share
                    </h1>
                </button>
            </div>
            <!-- Donate Now Button -->
            <div class="col-12 col-md-8 d-flex justify-content-center">
                <button class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center"
                    id="donateNowBtn">
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
                title: '<strong>Bentuk Donasi</strong>',
                html: `
                    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                        <!-- Button Donasi Barang -->
                        <button id="barangBtn" style="display: flex; align-items: center; gap: 10px; padding: 10px 20px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px; cursor: pointer;">
                            <img src="/images/donate/donasi.svg" alt="Barang Icon" style="width: 20px; height: 20px;" />
                            Donasi Barang
                        </button>
                        <!-- Button Donasi Uang -->
                        <button id="uangBtn" style="display: flex; align-items: center; gap: 10px; padding: 10px 20px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px; cursor: pointer;">
                            <img src="/images/donate/Money.svg" alt="Uang Icon" style="width: 20px; height: 20px;" />
                            Donasi Uang
                        </button>
                    </div>
                `,
                showConfirmButton: false,
                customClass: {
                    popup: 'custom-swal-popup'
                },
                didOpen: () => {
                    // Event listener untuk tombol Donasi Barang
                    document.getElementById('barangBtn').addEventListener('click', () => {
                        window.location.href =
                            '/donations/{{ $donation->slug }}/donation-item?slug={{ $donation->slug }}'; // Ganti dengan URL untuk Donasi Barang
                    });

                    // Event listener untuk tombol Donasi Uang
                    document.getElementById('uangBtn').addEventListener('click', () => {
                        window.location.href =
                            '/donations/{{ $donation->slug }}/donation-amount?slug={{ $donation->slug }}'; // Ganti dengan URL untuk Donasi Uang
                    });
                }
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const donateNowBtn = document.getElementById('shareNowBtn');
        if (donateNowBtn) {
            donateNowBtn.addEventListener('click', () => {
                Swal.fire({
                    title: '<strong>Bagikan ke Media Sosial</strong>',
                    html: `
                        <ul class="social-links" style="list-style: none; padding: 0; display: flex; gap: 10px; justify-content: center;">
                            <li>
                                <a href="https://www.instagram.com/?url={{ url()->current() }}" target="_blank" style="text-decoration: none; font-size: 24px;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" style="text-decoration: none; font-size: 24px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank" style="text-decoration: none; font-size: 24px;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" style="text-decoration: none; font-size: 24px;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                        </ul>
                    `,
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });
            });
        }
    });
</script>
@endsection
