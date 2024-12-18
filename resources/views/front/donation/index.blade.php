@extends('front.layout.app')

@section('seoMeta')
<!-- Meta tags for SEO -->
<meta name="description"
    content="{{ $config['meta_description'] }}">
<meta name="keywords"
    content="{{ $config['meta_keywords'] }}">
<meta name="author" content="{{ config('app.name', 'DonasiKita') }} Team">

<!-- Open Graph Meta Tags for social media sharing -->
<meta property="og:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
<meta property="og:description"
    content="{{ $config['meta_description'] }}">
<meta property="og:image" content="{{ $config['logo'] ?? asset('images/logo-navbar.svg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
<style>
    /* Styling Cards */
    .search-container {
        width: 50%;
        padding: 0 15px;
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

    .donation-card {
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin: 10px;
        /* Memberikan jarak antar card */
        min-height: 400px;
        /* Tinggi minimum untuk seragam */
        max-height: 400px;
        /* Tinggi maksimum untuk seragam */
    }

    .card-img-top {
        height: 160px;
        /* Tetapkan tinggi gambar */
        object-fit: cover;
        /* Gambar akan dipotong untuk menyesuaikan ukuran */
        width: 100%;
        border-bottom: 1px solid #e0e0e0;
    }

    .card-body {
        padding: 25px 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        text-align: left;
    }

    .card-text {
        font-size: 0.875rem;
        text-align: left;
        margin-bottom: 0.5rem;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        background-color: #f0f0f0;
    }

    .progress-bar {
        background-color: #3498db;
    }

    .text-muted {
        font-size: 0.75rem;
        color: #7d7d7d;
        text-align: left;
    }

    /* Paginasi Container */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
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

    /* Container Styling */
    #donation-cards .container {
        /* max-width: 1200px; */
        margin: 0 auto;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section2 w-100 align-items-center" style="background-image: url('/images/donation-hero.svg');">
    <div class="hero-overlay2"></div>
    <div class="hero-content2 text-left px-5 ms-5">
        <h1 class="hero-title2">@lang('messages.donation_header_title')</h1>
        <p class="hero-subtitle2">@lang('messages.donation_header_subtitle')</p>
    </div>
</section>
<!-- End Hero Section -->

<!-- Search Bar -->
<form>
    <section id="search-bar"
        style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
        <div class="search-container d-flex justify-content-center align-items-center">
            <div class="search-box">
                <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="ingin cari event apa hari ini?">
                <button class="btn search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </section>
</form>
<!-- End Search Bar -->

<!-- Cards Section -->
<section id="donation-cards" class="mb-5">
    <div class="container">
        <div class="row justify-content-center" id="card-container">
            @forelse ($donations as $donation)
            <a href="{{ route('donations.show', $donation->slug) }}" class="col-lg-4 col-md-6 mb-5">
                <div class="donation-card rounded rounded-5">
                    @if ($donation->thumbnail && $donation->thumbnail->file_path)
                    <img src="{{ $donation->thumbnail->file_path }}" class="card-img-top img-fluid blog-img"
                        alt="{{ $donation->title }}" style="object-fit: cover !important; height: 160px !important; width: 500px !important">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                        style="height: 160px;">
                        <span>No cover image</span>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-dark">
                            {{ Str::limit(strip_tags($donation->title), 50, '...') }}
                        </h5>
                        <h1 class="card-description text-muted" style="font-size:0.8rem ; width:90%; text-align: justify;">
                            {{ Str::limit(strip_tags($donation->description), 80, '...') }}
                        </h1>
                        <p class="card-text text-primary">{{ $donation->towards }}</p>
                        <div class="progress" style="margin-top: 1px">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ (str_replace(['Rp', '.', ','], '', $donation->total_donated) / intval(str_replace(['Rp', '.', ','], '', $donation->target_amount))) * 100 }}%">
                            </div>
                        </div>
                        <p class="card-text text-dark" style="margin-top: 5px;">
                            <strong>{{ number_format($donation->total_donated, 0, ',', '.') }}</strong> /
                            {{ number_format($donation->target_amount, 0, ',', '.') }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $donation->donator_count }} donatur</small>
                            <small
                                class="text-muted">{{ $donation->days_left->locale('id')->diffForHumans() ?? '0' }}</small>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <p class="text-center font-weight-bold mt-4">Tidak ada donasi yang ditemukan.</p>
            @endforelse


            <!-- Pagination -->
            <div class="pagination-container">
                <button class="pagination-arrow" id="prev-page">&lt;</button>
                <div class="pagination-dots" id="pagination-dots">
                    @for ($i = 1; $i <= $donations->lastPage(); $i++)
                        <span class="pagination-dot {{ $i == $donations->currentPage() ? 'active' : '' }}" data-page="{{ $i }}"></span>
                        @endfor
                </div>
                <button class="pagination-arrow" id="next-page">&gt;</button>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    var data = @json($donations);

    document.querySelectorAll('.pagination-dot').forEach(function(dot) {
        dot.addEventListener('click', function() {
            var page = this.getAttribute('data-page');
            // Pindahkan halaman sesuai nomor halaman yang diklik
            // Anda bisa memanfaatkan AJAX atau navigasi normal di sini
            window.location.href = `?page=${page}`;
        });
    });

    document.getElementById('prev-page').addEventListener('click', function() {
        var currentPage = document.querySelector('.pagination-dot.active');
        if (currentPage && currentPage.previousElementSibling) {
            currentPage.classList.remove('active');
            currentPage.previousElementSibling.classList.add('active');
            // Pindahkan halaman ke halaman sebelumnya
            var prevPage = currentPage.previousElementSibling.getAttribute('data-page');
            window.location.href = `?page=${prevPage}`;
        }
    });

    document.getElementById('next-page').addEventListener('click', function() {
        var currentPage = document.querySelector('.pagination-dot.active');
        if (currentPage && currentPage.nextElementSibling) {
            currentPage.classList.remove('active');
            currentPage.nextElementSibling.classList.add('active');
            // Pindahkan halaman ke halaman berikutnya
            var nextPage = currentPage.nextElementSibling.getAttribute('data-page');
            window.location.href = `?page=${nextPage}`;
        }
    });
</script>
@endsection