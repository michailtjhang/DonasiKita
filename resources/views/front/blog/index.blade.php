@extends('front.layout.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
    <style>
        /* Adjust Card Styling */

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
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: 15px;
            min-height: 270px;
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
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
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        .card-text {
            font-size: 0.875rem;
            text-align: left;
            margin-bottom: 1rem;
            min-height: 40px;
            max-height: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 2.5px;
            font-size: 0.85rem;
        }

        .card-buttons button {
            border: none;
            background-color: transparent;
            color: #6cb6de;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0;
        }

        .card-buttons button:hover {
            text-decoration: underline;
        }

        .card-buttons .divider {
            color: #ccc;
        }

        /* Styling the button */
        .see-all-categories {
            padding: 8px 16px;
            font-size: 14px;
            color: #3498db;
            border: 1px solid #3498db;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            background-color: white;
        }

        .see-all-categories:hover {
            background-color: #3498db;
            color: white;
        }

        .see-all-categories:active {
            background-color: #2874a6;
            color: white;
            border-color: #2874a6;
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

        #donation-cards .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">Blog</h1>
            <p class="hero-subtitle2">Temukan artikel inspiratif, tips, dan informasi terbaru tentang aksi kemanusiaan,
                lingkungan, kesehatan, dan hiburan yang mendukung kegiatan penggalangan dana.</p>
        </div>
    </section>

    <!-- Search Bar -->
    <form>
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <section id="search-bar"
            style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
            <div class="search-container d-flex justify-content-center align-items-center">
                <div class="search-box">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control border-0"
                        class="form-control" placeholder="ingin cari event apa hari ini?">
                    <button class="btn search-btn" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </form>
    <!-- End Search Bar -->

    <section id="blog-cards" class="my-5">
        <div class="container">
            <div class="container d-flex justify-content-between align-items-center my-4">
                <div>
                    <h1
                        style="font-size: 25px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #0F3D56; margin-bottom: 5px;">
                        Blog
                    </h1>
                    <p
                        style="font-size: 18px; font-weight: 400; font-family: 'Poppins', sans-serif; color: #0F3D56; line-height: 1.5;">
                        Temukan berbagai Blog menarik yang mendukung misi kemanusiaan dan edukasi tentang bencana.
                    </p>
                </div>
                <a href="{{ route('blogs.categories') }}" class="see-all-categories" id="categoriesButton">
                    See All Categories
                </a>
            </div>

            <div class="row" id="card-container">
                @forelse ($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('blog.show', $article->slug) }}">
                                @if ($article->thumbnail && $article->thumbnail->file_path)
                                    <img src="{{ asset('storage/cover/' . $article->thumbnail->file_path) }}"
                                        class="card-img-top img-fluid" alt="{{ $article->title }}">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                        style="height: 200px;">
                                        <span>No cover image available</span>
                                    </div>
                                @endif
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">
                                    <a href="{{ route('blog.show', $article->slug) }}"
                                        class="text-dark text-decoration-none">
                                        {{ $article->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">{{ Str::limit(strip_tags($article->content), 100, '...') }}
                                </p>
                                <div class="d-flex flex-wrap gap-1 align-items-center mt-3">
                                    <small class="text-muted">{{ $article->created_at->locale('id')->diffForHumans() }}</small>
                                    <span class="text-muted mx-1">|</span>
                                    <a href="/blogs?category={{ $article->category->slug }}"
                                        class="text-muted text-decoration-none">
                                        {{ $article->category->name }}
                                    </a>
                                    <span class="text-muted mx-1">|</span>
                                    <small class="text-muted">Oleh {{ $article->user->name ?? 'Anonim' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center font-weight-bold">Tidak ada artikel yang ditemukan.</p>
                @endforelse
            </div>

            <!-- Navigasi Slider -->
            <div class="pagination-container my-5 pb-5">
                <button class="pagination-arrow" id="prev-page">&lt;</button>
                <div class="pagination-dots" id="pagination-dots">
                    @for ($i = 1; $i <= $articles->lastPage(); $i++)
                        <span class="pagination-dot {{ $i == $articles->currentPage() ? 'active' : '' }}"
                            data-page="{{ $i }}"></span>
                    @endfor
                </div>
                <button class="pagination-arrow" id="next-page">&gt;</button>
            </div>
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
