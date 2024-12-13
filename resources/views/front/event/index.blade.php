@extends('front.layout.app')

@section('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
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
    <section class="hero-section2 w-100" style="background-image: url('/images/event-hero.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">Ikuti Beragam Acara Kebaikan</h1>
            <p class="hero-subtitle2-event">Temukan berbagai event menarik yang mendukung misi kemanusiaan.</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Search Bar -->
    <form>
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <section id="search-bar"
            style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
            <div class="search-container d-flex justify-content-center align-items-center">
                <div class="search-box">
                    <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}"
                        placeholder="ingin cari event apa hari ini?">
                    <button class="btn search-btn" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </form>
    <!-- End Search Bar -->

    <!-- Kategori Event -->
    <div class="container pt-2 mb-5">
        <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5 mx-md-5 px-2 mx-2">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="text-muted mb-0">Temukan berbagai event menarik yang mendukung misi kemanusiaan.</p>
                <a href="{{ route('events.categories') }}" class="btn rounded rounded-5 hover-bg-primary hover-text-white"
                    style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">See All Categories</a>
            </div>

            <!-- Wadah kartu -->
            <div id="card-container" class="row d-flex justify-content-center">
                @forelse ($events as $event)
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center mt-4">
                        <div class="event-card rounded rounded-5">
                            <!-- Thumbnail -->
                            @if ($event->thumbnail && $event->thumbnail->file_path)
                                <a href="{{ route('events.show', $event->slug) }}">
                                    <img src="{{ $event->thumbnail->file_path }}" alt="{{ $event->title }}"
                                        class="img-fluid overflow-hidden">
                                </a>
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                    style="height: 200px;">
                                    <p class="text-muted">Thumbnail Tidak Tersedia</p>
                                </div>
                            @endif

                            <!-- Date -->
                            <div class="event-card-spacer">
                                <div class="event-date">
                                    {{ $event->detailEvent->start->format('d M Y') ?? 'TBA' }}
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="event-details event-card-spacer">
                                <!-- Title -->
                                <p class="event-title fw-bold">
                                    {{ Str::limit(strip_tags($event->title), 8, '...') }}
                                </p>
                                <div class="event-info mt-2 d-flex justify-content-between event-card-spacer-short mb-3">
                                    <span><i class="fa fa-clock"></i> {{ $event->detailEvent->start->format('H:i') }} -
                                        {{ $event->detailEvent->end->format('H:i') }}</span>
                                    <span><i class="fa fa-location-dot"></i>
                                        {{ $event->location->name_location ?? 'TBA' }}</span>
                                </div>
                                <!-- Description -->
                                <p class="card-text  card-desc text-extra-small   small">
                                    {{ Str::limit(strip_tags($event->description), 60, '...') }}
                                </p>
                                <p class="card-text  text-extra-small  card-desc small mt-3">
                                    <a href="" class="me-2 text-light"><i class="fas fa-grip-horizontal"></i> {{ $event->category->name }} </a>
                                    <a href="" class="text-light"><i class="fa fa-user"></i> {{ $event->organizer ?? 'Anonim' }}</a>
                                </p>


                                <!-- Time and Location -->

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-4 pt-4">No events found.</p>
                @endforelse
            </div>

            <!-- Navigasi Slider -->
            <div class="pagination-container pt-5">
                <button class="pagination-arrow" id="prev-page">&lt;</button>
                <div class="pagination-dots" id="pagination-dots">
                    @for ($i = 1; $i <= $events->lastPage(); $i++)
                        <span class="pagination-dot {{ $i == $events->currentPage() ? 'active' : '' }}"
                            data-page="{{ $i }}"></span>
                    @endfor
                </div>
                <button class="pagination-arrow" id="next-page">&gt;</button>
            </div>

        </div>
    </div>
    <!-- End Kategori Event -->
@endsection

@section('script')
    <script>
        var data = @json($events);
        
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
