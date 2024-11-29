@extends('front.layout.app')

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
        border-radius: 15px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        margin: 10px;
        /* Memberikan jarak antar card */
        min-height: 380px;
        /* Tinggi minimum untuk seragam */
        max-height: 380px;
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
        padding: 1rem;
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

    /* Pagination Styling */
    .pagination-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .pagination-dots {
        display: flex;
        gap: 8px;
        align-items: center;
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

    .pagination-arrow {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: none;
        background-color: #bbddf0;
        color: #0f3d56;
        font-size: 18px;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .pagination-arrow:hover {
        background-color: #a9cce3;
    }

    /* Container Styling */
    #donation-cards .container {
        max-width: 1200px;
        margin: 0 auto;
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

<!-- Cards Section -->
<section id="donation-cards" class="space-section">
    <div class="container">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Left Section: Title and Description -->
            <div>
                <h1 style="font-size: 25px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #0F3D56; margin-bottom: 5px;">
                    Bergabung dalam Gerakan Kebaikan
                </h1>
                <p style="font-size: 18px; font-weight: 400; font-family: 'Poppins', sans-serif; color: #0F3D56; line-height: 1.5;">
                    Ribuan donatur telah membantu, sekarang giliran Anda untuk membuat perbedaan nyata.
                </p>
            </div>
        </div>

        <div class="row justify-content-center" id="card-container">
            @foreach ($donations as $donation)            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="donation-card">
                    <img src="{{$donation['img']}}" class="card-img-top" alt="{{$donation['title']}}" style="height: 200px !important;">
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{$donation['title']}}</h5>
                        <p class="card-text text-muted">{{$donation['category']}}</p>
                        <div class="progress my-3">
                            <div class="progress-bar" role="progressbar" style="width: {{ (intval(str_replace(['Rp', '.', ','], '', $donation['collected'])) / intval(str_replace(['Rp', '.', ','], '', $donation['target']))) * 100 }}%"></div>
                        </div>
                        <p class="card-text"><strong>{{$donation['collected']}}</strong> / {{$donation['target']}}</p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{$donation['donors']}}</small>
                            <small class="text-muted">{{$donation['daysLeft']}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>

        <!-- Pagination -->
        {{-- <div class="pagination-container my-5 pb-5">
            <button class="pagination-arrow" id="prev-page">&lt;</button>
            <div class="pagination-dots" id="pagination-dots">
                @for ($i = 1; $i <= $donations->lastPage(); $i++)
                    <span class="pagination-dot {{ $i == $donations->currentPage() ? 'active' : '' }}" data-page="{{ $i }}"></span>
                    @endfor
            </div>
            <button class="pagination-arrow" id="next-page">&gt;</button>
        </div> --}}
    </div>
</section>
    @endsection
    @section('script')
    <script>
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