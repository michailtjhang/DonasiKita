@extends('front.layout.app')
@section('style')
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
</style>
@endsection

@section('content')
<div class="space-section"></div>


<section id="detail-donation" class="container">
    <div class=" rounded-4 ">
        <p class="card-title fw-bold text-dark my-4 h1">{{ $event->title }}</p>
        @if ($event->thumbnail && $event->thumbnail->file_path)
        <img src="{{ asset('storage/cover/' . $event->thumbnail->file_path) }}" alt="{{ $event->title }}"
            class="card-img-top img-fluid rounded">
        @else
        <span class="d-block mb-2 text-muted">{{ $event->title }}</span>
        @endif

        <p class="h4">
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
                    <div class="container border rounded-3 pb-2 mb-5" id="event-schedule">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold pt-2 pb-5 h3">Peserta</p>
                            <span style="font-size: 0.9rem;"
                                class="pt-5 mt-1">150/{{ $event->detailEvent->capacity_participants }} Peserta
                                Mendaftar</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress " style="height: 3px; background-color: #bbddf0;">
                            <div class="progress-bar " role="progressbar"
                                style="width: 15%; background-color: #2492CD; " aria-valuenow="150" aria-valuemin="0"
                                aria-valuemax="1000">

                            </div>
                        </div>
                        <p class="h3 pt-3">
                            Acara dimulai dengan sambutan, dilanjutkan kunjungan stand, lelang barang donasi, hiburan
                            musik, dan diakhiri dengan penghargaan serta pengumuman hasil donasi.
                        </p>
                        <br>
                        <ul class="h3">
                            <li class="mb-1"><strong>Location: </strong>{{ $event->location->name_location ?? 'TBA' }}
                            </li>
                            <li class="mb-1"><strong>Jam:
                                </strong>{{ $event->detailEvent->start->format('H:i') ?? 'TBA' }}–{{ $event->detailEvent->end->format('H:i') ?? 'TBA' }}
                            </li>
                        </ul>
                    </div>

                    <div class="container border rounded-3 " id="event-schedule2">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold pt-2 pb-5 h3">Peserta Volunteer</p>
                            <span style="font-size: 0.9rem;"
                                class="pt-5 mt-1">10/{{ $event->detailEvent->capacity_volunteer ?? 0 }} Sukarelawan
                                Mendaftar</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress " style="height: 3px; background-color: #bbddf0;">
                            <div class="progress-bar " role="progressbar"
                                style="width: 15%; background-color: #2492CD; " aria-valuenow="150" aria-valuemin="0"
                                aria-valuemax="1000">

                            </div>
                        </div>
                        <p class="h3 pt-3">
                            Jadilah Sukarelawan dalam event kemanusiaan ini! Ayo berkontribusi dengan tenaga dan waktu
                            untuk mendukung misi kemanusiaan di lokasi yang telah ditentukan.
                            <br>
                            <br>
                            <strong>Yang Di Butuhkan:</strong> Tenaga Kerja, Pembagian Brosur, Koordinasi Acara
                        </p>
                        <br>
                        <ul class="h3">
                            <li class="mb-1"><strong>Location: </strong>Gedung Serba Guna, Jakarta, Jawa Barat,
                                Indonesia</li>
                            <li class="mb-1"><strong>Waktu: </strong>7.30:00–17:00</li>
                            <li class="mb-1"><strong>Hari: </strong>15 Des 2025</li>
                            <li class="mb-1"><strong>DressCode </strong>Casual, warna biru</li>
                        </ul>
                    </div>

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
    <div class="row g-1 px-lg-5 mx-lg-4 justify-content-center">
        <!-- Share Button -->
        <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0 mb-lg-0">
            <button class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center"
                style="background-color: #bbddf0;">
                <h1 class="d-flex align-items-center mb-0" style="font-size: 1.5rem; color: #0f3d56;">
                    <i class="fas fa-share-alt me-2"></i> Share
                </h1>
            </button>
        </div>
        <!-- Donate Now Button -->
        <div class="col-12 col-md-8 d-flex justify-content-center">
            <button id="donateNowBtn"
                class="btn btn-primary w-100 py-4 d-flex justify-content-center align-items-center">
                <h1 class="mb-0" style="font-size: 1.5rem;">Donate Now</h1>
            </button>
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
            <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Donate</button>
            <a href="{{ url('/event') }}">
                <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Sukarelawan</button>
            </a>
        </div>
    </div>
</section>
<!-- End Blog Invitatitation -->
@endsection
@section('script')
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
<script>
    document.getElementById('donateNowBtn').addEventListener('click', () => {
        Swal.fire({
            title: '<strong>Gabung Sebagai</strong>',
            html: `
        <button id="pesertaBtn" style="width: 100%; margin: 5px 0; padding: 10px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px;">
            Peserta
        </button>
        <button id="sukarelawanBtn" style="width: 100%; margin: 5px 0; padding: 10px; background-color: #6cb2eb; border: none; border-radius: 5px; color: white; font-size: 16px;">
            Sukarelawan
        </button>
        `,
            showConfirmButton: false,
            customClass: {
                popup: 'custom-swal-popup'
            },
            didOpen: () => {
                // Event listener untuk tombol Peserta
                document.getElementById('pesertaBtn').addEventListener('click', () => {
                    Swal.fire('Anda memilih Peserta!');
                });

                // Event listener untuk tombol Sukarelawan
                document.getElementById('sukarelawanBtn').addEventListener('click', () => {
                    Swal.fire('Anda memilih Sukarelawan!');
                });
            }
        });
    });
</script>
<script>
    // Event Listener untuk tombol Peserta
    document.getElementById('btnPeserta').addEventListener('click', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Anda telah bergabung sebagai Peserta.',
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true
        });
    });

    // Event Listener untuk tombol Sukarelawan
    document.getElementById('btnSukarelawan').addEventListener('click', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Anda telah bergabung sebagai Sukarelawan.',
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi Leaflet Map dengan lokasi Jakarta Selatan
        const map = L.map('map').setView([{
                {
                    $event - > location - > latitude ?? '-6.200000'
                }
            },
            {
                {
                    $event - > location - > longitude ?? '106.816666'
                }
            }
        ], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Tambahkan marker dengan warna merah
        L.marker([-6.261493, 106.810691], { // Koordinat marker
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                iconSize: [25, 41], // Ukuran icon
                iconAnchor: [12, 41], // Posisi anchor icon
                popupAnchor: [1, -34], // Posisi popup
                shadowSize: [41, 41] // Ukuran shadow
            })
        }).addTo(map).bindPopup('{{ $event->location->name_location ?? "TBA" }}').openPopup();

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