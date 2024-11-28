@extends('front.layout.app')
@section('style')
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
            <h1 class="hero-title2">{{ ucfirst($categories) }}</h1>
            <p class="hero-subtitle2-event">Category > {{ ucfirst($categories) }}</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <div class="container mt-5">

        <!-- Event -->
        @if ($events->count())
            <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5 mx-md-5 px-2 mx-2">
                <h2 class="fw-bold">Event</h2>
                <p class="text-muted">Menampilkan event kategori "{{ ucfirst($categories) }}"</p>

                <!-- Card Container -->
                <div id="card-container" class="row">
                    @forelse ($events as $event)
                        <div class="col-md-4 col-lg-4 d-flex justify-content-center mt-4">
                            <div class="card h-100 shadow-sm rounded">
                                <!-- Event Image -->
                                <a href="{{ route('events.show', $event->slug) }}">
                                    @if ($event->thumbnail && $event->thumbnail->file_path)
                                        <img src="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}"
                                            alt="Event Image" class="card-img-top img-fluid">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                            style="height: 200px;">
                                            <span>No Image Available</span>
                                        </div>
                                    @endif
                                </a>

                                <!-- Event Details -->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">
                                        <a href="{{ route('events.show', $event->slug) }}" class="text-dark text-decoration-none">{{ $event->title }}</a>
                                    </h5>
                                    <div class="card-text text-muted small mb-3">
                                        <span><i
                                                class="fa fa-calendar me-2"></i>{{ $event->detailEvent->start->format('d F Y') }}
                                            - {{ $event->detailEvent->end->format('d F Y') }}</span>
                                        <span><i
                                                class="fa fa-clock me-2"></i>{{ $event->detailEvent->start->format('H:i') }}
                                            -
                                            {{ $event->detailEvent->end->format('H:i') }}
                                        </span><br>
                                        <span><i
                                                class="fa fa-location-dot me-2"></i>{{ $event->location->name_location ?? 'Unknown Location' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">{{ $event->created_at->format('d M Y') }}</small>
                                        <a href="{{ route('events.category', $event->category->slug) }}"
                                            class="badge bg-primary text-light text-decoration-none">
                                            {{ $event->category->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center font-weight-bold">Tidak ada event yang ditemukan.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
