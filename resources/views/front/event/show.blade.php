@extends('front.layout.app')

@section('csrfMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('seoMeta')
    <!-- Meta tags for SEO -->
    <meta name="description"
        content="{{ Str::limit(strip_tags($event->content), 150, '...') }}">
    <meta name="keywords"
        content="{{ $keywords }}">
    <meta name="author" content="{{ config('app.name', 'DonasiKita') }} Team">

    <!-- Open Graph Meta Tags for social media sharing -->
    <meta property="og:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
    <meta property="og:description"
        content="{{ Str::limit(strip_tags($event->description), 150, '...') }}">
    <meta property="og:image" content="{{ $event->thumbnail->file_path ?? asset('images/logo-navbar.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
    <meta name="twitter:description"
        content="{{ Str::limit(strip_tags($event->description), 150, '...') }}">
    <meta name="twitter:image" content="{{ $event->thumbnail->file_path ?? asset('images/logo-navbar.svg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Additional Meta Tags -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
@endsection

@section('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Custom CSS Swal Alert -->
    @if (!auth()->check())
        // Periksa jika pengguna belum login
        <style>
            /* Custom styling untuk tombol */
            .btn-confirm {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                margin-right: 15px;
                /* Jarak ke tombol "Batal" */
            }

            .btn-cancel {
                background-color: #6c757d;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
            }

            /* Custom styling untuk container tombol */
            .custom-actions {
                justify-content: center;
                /* Posisikan tombol di tengah */
                gap: 15px;
                /* Tambahkan jarak antar tombol */
            }
        </style>
    @endif

    <!-- Custom CSS -->
    <style>
        .custom-tabs {
            display: flex;
            background-color: #6cb6de !important;
            /* Warna tab background */
            border-radius: 8px 8px 0 0;
            /* Membuat sudut atas melengkung */
            overflow: hidden;
            color: #6cb6de !important;

        }

        .custom-tab {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            cursor: pointer;
            background-color: #6cb6de;
            /* Warna default tab */
            color: #000;
            /* Warna teks */
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: x-large;
        }

        .custom-tab.active {
            background-color: white;
            /* Warna tab aktif */
            color: black;
            /* Warna teks tab aktif */
            border-radius: 8px 8px 0 0;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        #map-content {
            visibility: hidden;
            /* Initially hidden */
            height: 0;
            /* Initially collapsed */
            transition: visibility 0.3s ease, height 0.3s ease;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        #shareNowBtn:hover{
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
    </style>
@endsection

@section('content')
    <div class="space-section"></div>


    <section id="detail-donation" class="container">
        <div class=" rounded-4 ">
            <p class="card-title fw-bold text-dark my-4 h1">{{ $event->title }}</p>
            @if ($event->thumbnail && $event->thumbnail->file_path)
                <img src="{{ $event->thumbnail->file_path }}" alt="{{ $event->title }}"
                    class="card-img-top img-fluid rounded rounded-3">
            @else
                <span class="d-block mb-2 text-muted">{{ $event->title }}</span>
            @endif

            <p class="h4 mt-5">
                {!! $event->description !!}
            </p>

            <div class=" py-5">
                <div class="card shadow">
                    <!-- Custom Tabs -->
                    <div class="custom-tabs bg-dark mb-4" style="background-color: #6cb6de !important; color:#f8fcff">
                        <div class="custom-tab active fw-bold">
                            <span class="custom-teks " style="font-size: clamp(1.2rem, 2.5vw, 2rem);">
                                Event Schedule
                            </span>
                        </div>
                        <div class="custom-tab">
                            <span class="custom-teks fw-light" style="font-size: clamp(1rem, 2vw, 1.5rem);">
                                Map Location
                            </span>
                        </div>

                    </div>


                    <!-- Card Body -->
                    <div class="card-body mx-lg-4" id="card-content">
                        <!-- Default Content -->
                        <div class="containerpb-2 mb-5" id="event-schedule">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold pt-2 pb-5 h3">Peserta</p>
                                <span style="font-size: 0.9rem;"
                                    class="pt-5 mt-1">{{ $partisipan['peserta']->count() }}/{{ $event->detailEvent->capacity_participants }}
                                    Peserta
                                    Mendaftar</span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress " style="height: 3px; background-color: #bbddf0;">
                                <div class="progress-bar " role="progressbar"
                                    style="width: {{ ($partisipan['peserta']->count() * 100) / $event->detailEvent->capacity_participants }}%; background-color: #2492CD; "
                                    aria-valuenow="150" aria-valuemin="0" aria-valuemax="1000">

                                </div>
                            </div>
                            <p class="h3 pt-3">
                                {{ $event->detailEvent->description_participants }}
                            </p>
                            <br>
                            <ul class="h3">
                                <li class="mb-1"><strong>Location:
                                    </strong>{{ $event->location->name_location ?? 'TBA' }}
                                </li>
                                <li class="mb-1"><strong>Jam:
                                    </strong>{{ $event->detailEvent->start->format('H:i') ?? 'TBA' }}–{{ $event->detailEvent->end->format('H:i') ?? 'TBA' }}
                                </li>
                            </ul>
                        </div>

                        @if ($event->detailEvent->requires_volunteers == true)
                            <div class="container" id="event-schedule2">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="fw-bold pt-2 pb-5 h3">Peserta Volunteer</p>
                                    <span style="font-size: 0.9rem;"
                                        class="pt-5 mt-1">{{ $partisipan['sukarelawan']->count() }}/{{ $event->detailEvent->capacity_volunteers ?? 0 }}
                                        Sukarelawan
                                        Mendaftar</span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="progress " style="height: 3px; background-color: #bbddf0;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $event->detailEvent->capacity_volunteers > 0 ? ($partisipan['sukarelawan']->count() * 100) / $event->detailEvent->capacity_volunteers : 0 }}%; background-color: #2492CD;"
                                        aria-valuenow="150" aria-valuemin="0" aria-valuemax="1000">
                                    </div>
                                </div>
                                <p class="h3 pt-3">
                                    {{ $event->detailEvent->description_volunteers }}
                                </p>
                                <br>
                                <ul class="h3">
                                    <li class="mb-1"><strong>Location:
                                        </strong>{{ $event->location->name_location ?? 'TBA' }}
                                    </li>
                                    <li class="mb-1"><strong>Jam:
                                        </strong>{{ $event->detailEvent->start->format('H:i') ?? 'TBA' }}–{{ $event->detailEvent->end->format('H:i') ?? 'TBA' }}
                                    </li>
                                </ul>
                            </div>
                        @endif

                        <!-- Map Content (Hidden by Default) -->
                        <div id="map-content">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Button Share and Donate -->
    <div class="container my-5">
        <div class="row g-1 justify-content-center">
            <!-- Share Button -->
            <div class="col-12 col-md-4  d-flex justify-content-center mb-3 mb-md-0 mb-lg-0">
                <button id="shareNowBtn" class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center"
                    style="background-color: #bbddf0;">
                    <h1 class="d-flex align-items-center mb-0" style="font-size: 1.5rem; color: #0f3d56;">
                        <i class="fas fa-share-alt me-2"></i> Share
                    </h1>
                </button>
            </div>
            <!-- Join Now Button -->
            <div class="col-12 col-md-8 d-flex justify-content-center">
                @if ($userJoined)
                    <button class="btn btn-success w-100 py-4 d-flex justify-content-center align-items-center" disabled>
                        <h1 class="mb-0" style="font-size: 1.5rem;">Berhasil Join</h1>
                    </button>
                @else
                    <button id="donateNowBtn"
                        class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center">
                        <h1 class="mb-0" style="font-size: 1.5rem;">Join Now</h1>
                    </button>
                @endif
            </div>
        </div>
    </div>


    <!-- Blog Invitatitation -->
    <section id="blog-invitation" class="space-section">
        <div class="banner py-0 w-100">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <h1 style="font-size: 60px;">Your help means a lot</h1>
                <p style="font-size: 41px;">donate or be a volunteer now!</p>
                <a href="{{ url('/donations') }}" class="btn btn-custom btn-primary" id="button-event" style="font-size: 24px;">Donate</a>
                <a href="{{ url('/events') }}">
                    <button class="btn btn-primary btn-custom" id="button-event" style="font-size: 24px;">Sukarelawan</button>
                </a>
            </div>
        </div>
    </section>
    <!-- End Blog Invitatitation -->
@endsection

@section('script')
    <!-- Custom JS -->
    <script>
        const tabs = document.querySelectorAll('.custom-tab');
        const cardContent = document.getElementById('card-content');
        const eventSchedule = document.getElementById('event-schedule');
        const eventSchedule2 = document.getElementById('event-schedule2');
        const mapContent = document.getElementById('map-content');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                // Reset semua tab
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.querySelector('.custom-teks').classList.add('fw-light');
                });

                // Set tab yang diklik menjadi aktif
                tab.classList.add('active');
                tab.querySelector('.custom-teks').classList.remove('fw-light');

                // Ganti konten berdasarkan tab yang diklik
                if (index === 0) {
                    eventSchedule.style.display = 'block';
                    eventSchedule2.style.display = 'block';
                    mapContent.style.display = 'hidden';
                } else if (index === 1) {
                    eventSchedule.style.display = 'none';
                    eventSchedule2.style.display = 'none';
                    mapContent.style.display = 'block';
                }
            });
        });
    </script>

    <!-- Sweet Alert -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const donateNowBtn = document.getElementById('donateNowBtn');
        if (donateNowBtn) {
            donateNowBtn.addEventListener('click', () => {
                @if (!auth()->check()) // Periksa jika pengguna belum login
                    Swal.fire({
                        title: 'Login Diperlukan',
                        text: 'Anda harus login terlebih dahulu untuk bisa Join Event.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Login Sekarang',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-secondary',
                            actions: 'custom-actions'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}"; // Redirect ke halaman login
                        }
                    });
                @else
                    let volunteerButton = '';
                    @if ($event->detailEvent->requires_volunteers == true)
                        volunteerButton = `
                            <button id="sukarelawanBtn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 25px; background-color: #2185BB; border: none; border-radius: 8px; color: white; font-size: 16px; font-family: Poppins, sans-serif; cursor: pointer;">
                                <img src="/images/event/sukarelawan.svg" alt="Icon Sukarelawan" style="width: 24px; height: 24px;" />
                                Sukarelawan
                            </button>`;
                    @endif

                    Swal.fire({
                        title: '<strong>Ingin berkontribusi?</strong>',
                        html: `
                            <p style="font-size: 14px; color: #555; font-family: Poppins, sans-serif; text-align: center; margin-top: 10px;">
                                Pilih peranmu sebagai <b>Peserta</b> atau <b>Sukarelawan</b> dan mulailah beraksi bersama kami!
                            </p>
                            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                                <button id="pesertaBtn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 25px; background-color: #2185BB; border: none; border-radius: 8px; color: white; font-size: 16px; font-family: Poppins, sans-serif; cursor: pointer;">
                                    <img src="/images/event/peserta.svg" alt="Icon Peserta" style="width: 24px; height: 24px;" />
                                    Peserta
                                </button>
                                ${volunteerButton}
                            </div>
                        `,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'custom-swal-popup'
                        },
                        didOpen: () => {
                            const pesertaBtn = document.getElementById('pesertaBtn');
                            const sukarelawanBtn = document.getElementById('sukarelawanBtn');

                            const handleButtonClick = (status) => {
                                Swal.fire({
                                    title: 'Processing...',
                                    allowOutsideClick: false,
                                    didOpen: () => Swal.showLoading()
                                });

                                fetch('{{ route('events.join') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        event_id: '{{ $event->event_id }}',
                                        status: status
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.close();
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: `Anda telah bergabung sebagai ${status}.`,
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: data.message || 'Terjadi kesalahan.'
                                        });
                                    }
                                })
                                .catch(() => {
                                    Swal.close();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                                    });
                                });
                            };

                            if (pesertaBtn) pesertaBtn.addEventListener('click', () => handleButtonClick('peserta'));
                            if (sukarelawanBtn) sukarelawanBtn.addEventListener('click', () => handleButtonClick('sukarelawan'));
                        }
                    });
                @endif
            });
        }
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


    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi Leaflet Map dengan lokasi Jakarta Selatan
            const map = L.map('map').setView([
                {{ $event->location->latitude ?? '-6.200000' }},
                {{ $event->location->longitude ?? '106.816666' }}
            ], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            L.marker([
                {{ $event->location->latitude ?? '-6.200000' }},
                {{ $event->location->longitude ?? '106.816666' }}
            ], {
                icon: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(map).bindPopup('{{ $event->location->name_location ?? 'TBA' }}').openPopup();

            // Element referensi
            const tabs = document.querySelectorAll('.custom-tab');
            const eventSchedule = document.getElementById('event-schedule');
            const mapContent = document.getElementById('map-content');

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    // Reset semua tab
                    tabs.forEach(t => {
                        t.classList.remove('active');
                        t.querySelector('.custom-teks').classList.add('fw-light');
                    });

                    // Set tab yang diklik menjadi aktif
                    tab.classList.add('active');
                    tab.querySelector('.custom-teks').classList.remove('fw-light');

                    // Kontrol visibilitas konten
                    if (index === 0) {
                        eventSchedule.style.display = 'block';
                        mapContent.style.visibility = 'hidden';
                        mapContent.style.height = '0';
                    } else if (index === 1) {
                        eventSchedule.style.display = 'none';
                        mapContent.style.visibility = 'visible';
                        mapContent.style.height = '100vh';

                        // Panggil invalidateSize setelah map terlihat
                        setTimeout(() => {
                            map.invalidateSize();
                        }, 300); // Beri waktu agar transisi selesai
                    }
                });
            });
        });
    </script>
@endsection
