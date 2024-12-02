@extends('front.layout.app')

@section('style')
    <style>
        /* Styling untuk kategori */
        .card-category {
            background: #F8FCFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-category img {
            width: 100%;
            height: 221px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-category h3 {
            font-size: 24px;
            font-weight: 700;
            color: #0F3D56;
            margin: 10px 0 5px;
            text-align: center;
        }

        .card-category p {
            font-size: 16px;
            color: #2185BB;
            line-height: 1.5;
        }

        .categories-title {
            color: #0F3D56;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .categories-subtitle {
            color: #0F3D56;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .card-text-wrapper {
            padding: 25px 25px;
        }

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
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">Blog & Article</h1>
            <p class="hero-subtitle2-event">Category > </p>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Search Bar -->
    <form action="{{ route('blog') }}">
        <section id="search-bar"
            style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
            <div class="search-container d-flex justify-content-center align-items-center">
                <div class="search-box">
                    <input type="text" name="keyword" class="form-control" placeholder="ingin cari artikel apa hari ini?"
                        value="{{ old('keyword') }}">
                    <button class="btn search-btn" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </form>

    <!-- End Search Bar -->
    <div class="container mt-5">

        <!-- Header Kategori -->
        <div class="text-left pt-5">
            <h1 class="categories-title">Categories</h1>
            <p class="categories-subtitle">All Category</p>
        </div>

        <!-- Kartu Kategori -->
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('blogs.category', $category->slug) }}" class="text-decoration-none">
                        <div class="card-category rounded rounded-5">
                            @if ($category->thumbnail && $category->thumbnail->id_file)
                                    <x-cld-image public-id="{{ $category->thumbnail->id_file }}"
                                        class="card-img-top img-fluid" />
                            @elseif ($category->thumbnail && $category->thumbnail->file_path)
                                <img src="{{ asset('storage/cover/' . $category->thumbnail->file_path) }}"
                                    alt="{{ $category->name }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                    style="height: 200px;">
                                    <span>No cover image</span>
                                </div>
                            @endif
                            <div class="card-text-wrapper">
                                <h3>{{ $category->name }}</h3>
                                <p class="text-center">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Navigasi Slider -->
        <div class="pagination-container my-5 pb-5">
            <button class="pagination-arrow" id="prev-page">&lt;</button>
            <div class="pagination-dots" id="pagination-dots">
                @for ($i = 1; $i <= $categories->lastPage(); $i++)
                    <span class="pagination-dot {{ $i == $categories->currentPage() ? 'active' : '' }}"
                        data-page="{{ $i }}"></span>
                @endfor
            </div>
            <button class="pagination-arrow" id="next-page">&gt;</button>
        </div>

    </div>
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
