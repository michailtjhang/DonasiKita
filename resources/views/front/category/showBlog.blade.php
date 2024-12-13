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
    <style>
        /* Adjust Card Styling */
        .donation-card {
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: 15px;
            height: auto;
            /* Default tinggi otomatis */
            min-height: 300px;
            /* Tambahkan tinggi minimum seragam */
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            width: 100%;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-body {
            padding: 30px 25px;
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
            font-size: 0.9rem;
        }

        .card-buttons button {
            border: none;
            background-color: transparent;
            color: #6cb6de;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            gap: 2.5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hero-subtitle2 {
            white-space: nowrap;
            overflow: show;
            text-overflow: ellipsis;
        }

        .card-buttons button:hover {
            text-decoration: underline;
        }

        .card-buttons .divider {
            color: #ccc;
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
    <!-- Hero Section -->
    <section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">{{ ucfirst($categories) }}</h1>
            <p class="hero-subtitle2-event">Category > {{ ucfirst($categories) }}</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <div class="container mt-5">
        <!-- Artikel -->
        <div class="container justify-content-center space-x">
            <h2 class="fw-bold">Artikel</h2>
            <p class="text-muted">Menampilkan artikel kategori "{{ ucfirst($categories) }}"</p>
            <div id="card-container" class="row">
                @forelse ($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card rounded rounded-5 h-100 shadow-sm">
                            <div class="position-relative">
                                <a href="{{ route('blog.show', $article->slug) }}">
                                    @if ($article->thumbnail && $article->thumbnail->file_path)
                                        <img src="{{ $article->thumbnail->file_path }}"
                                            class="card-img-top img-fluid blog-img" alt="{{ $article->title }}">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                            style="height: 200px;">
                                            <span>No cover image available</span>
                                        </div>
                                    @endif
                                    <div class="blog-date">
                                        {{ $article->created_at->locale('id')->diffForHumans() ? $article->created_at->locale('id')->diffForHumans() : 'Tanggal tidak tersedia' }}
                                    </div>
                                </a>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title mb-3">
                                    <a href="{{ route('blog.show', $article->slug) }}"
                                        class="text-dark text-decoration-none">
                                        {{ Str::limit(strip_tags($article->title), 16, '...') }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted mb-3">
                                    {{ Str::limit(strip_tags($article->content), 100, '...') }}
                                </p>
                                <div class="text-primary text-small mb-3">
                                    <a href="/blogs?category={{ $article->category->slug }}" class="me-2"><i
                                            class="fas fa-grip-horizontal text-dark"></i> {{ $article->category->name }}
                                    </a>
                                    <a href=""><i class="fa fa-user text-dark"></i>
                                        {{ $article->user->name ?? 'Anonim' }}</a>
                                </div>
                                <div class="d-flex w-100 justify-content-center mt-2">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="btn blog-btn">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center font-weight-bold">Tidak ada artikel yang ditemukan.</p>
                @endforelse
            </div>
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
    </div>
@endsection

@section('script')
    <script>
        console.log(@json($articles))
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
