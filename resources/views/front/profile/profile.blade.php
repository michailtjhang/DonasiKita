@extends('front.layout.app')
@section('seoMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('style')
<style>
    .profile-container {
        width: 70%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px;
        background: #F8FCFF;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 50px;
    }

    /* Profile Image Container */
    .profile-image-container {
        width: 200px;
        height: 200px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        margin-right: 20px;
        cursor: pointer; /* Menambahkan cursor pointer untuk menunjukkan interaksi */
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Popup Overlay */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none; /* Pop-up disembunyikan secara default */
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* Popup Content */
    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        text-align: center;
    }

    .popup-content h3 {
        margin-bottom: 20px;
    }

    .popup-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .popup-buttons button {
        padding: 10px;
        font-size: 16px;
        border: none;
        background-color: #0F3D56;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .popup-buttons button:hover {
        background-color: #3498db;
    }

    /* Form Container */
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 100%;
        max-width: 600px;
    }

    .form-container input {
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ccc;
        width: 100%;
    }

    .form-container label {
        font-size: 18px;
        color: #0F3D56;
        margin-bottom: 2px;
        font-weight: 700;
    }

    /* Button Container */
    .button-container {
        display: flex;
        gap: 20px;
        justify-content: flex-start;
        margin-top: 20px;
    }

    .change-password-button, .logout-button {
        padding: 10px 20px;
        font-size: 16px;
        border: 1.5px solid #0F3D56;
        background-color: #fff;
        color: #0F3D56;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .save-changes-button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        background-color: #0F3D56;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .save-changes-button:hover {
        background-color: #08354e;
    }

    .change-password-button:hover, .logout-button:hover {
        background-color: #f1f1f1;
    }

    .category-color {
    color: #ffffff;  /* Warna putih */
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

        /* Profile Image Container */
        .profile-image-container {
            width: 200px;
            height: 200px;
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            margin-right: 20px;
            cursor: pointer;
            /* Menambahkan cursor pointer untuk menunjukkan interaksi */
        }
    }
    
</style>
@endsection

@section('content')
    <div class="space-section"></div>

    <div class="profile-container my-5 pt-5">
        <!-- Profile Image Section -->
        <div class="profile-image-container" onclick="openProfilePicturePopup()">
            <img src="{{ auth()->user()->media ? auth()->user()->media->cloudinary_url : 'https://www.w3schools.com/w3images/avatar2.png' }}"
                alt="Profile Image" class="profile-image" />
        </div>
        
        <!-- Profile Form Section -->
        <div class="form-container">
        
            @include('_message')
            
            <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                    class="@error('name') is-invalid @enderror" />

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                    class="@error('email') is-invalid @enderror" />

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Enter your password">
                        <button class="btn btn-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Button Section -->
                <div class="button-container">
                    <button type="submit" class="save-changes-button">Save Changes</button>
                    <a href="{{ route('logout') }}" class="logout-button">Logout</a>
                </div>

            </form>

        </div>
    </div>

    <!-- Popup Modal untuk Edit Profile Picture -->
    <div id="profilePicturePopup" class="popup-overlay">
        <div class="popup-content">
            <h3>Edit Profile Picture</h3>
            <div class="popup-buttons">
                <!-- Button untuk memunculkan form input file -->
                <button onclick="showFileInput()">Change Picture</button>
                <button onclick="removeProfilePicture()">Remove Picture</button>
                <button onclick="closeProfilePicturePopup()">Cancel</button>
            </div>

            <!-- Form Input File (Sembunyi pada awalnya) -->
            <div id="fileInputContainer" style="display: none; padding-top: 10px;">
                <input type="file" id="profilePictureInput" accept="image/*" style="margin-top: 10px;">
                <button onclick="uploadProfilePicture()" style="margin-top: 10px;">Upload</button>
            </div>
        </div>
    </div>

    <!-- Current Event -->
    <div class="container mt-5">
        <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5 mx-md-5 px-2 mx-2 ">
            <h2 class="fw-bold">Event yang sedang diikuti</h2>
            <p class="text-muted">Selesaikan event untuk membantu saudara kita</p>
            <!-- Wadah kartu untuk Current Event -->
            <div id="current-card-container" class="row d-flex justify-content-center">
                <!-- Kartu akan dimuat di sini oleh JavaScript -->
            </div>

            <!-- Navigasi Slider -->
            <div class="pagination-container  my-5 pb-5">
                <button class="pagination-arrow" id="prev-page">&lt;</button>
                <div class="pagination-dots" id="pagination-dots"></div>
                <button class="pagination-arrow" id="next-page">&gt;</button>
            </div>
        </div>
    </div>
    <!-- End Current Event -->

<!-- Followed Event -->
<section id="folowed-event" class="container pt-2 mb-5">
    <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5  mx-md-5 px-2  mx-2 ">
        <h2 class="fw-bold">Event yang Diikuti</h2>
        <p class="text-muted">Selesaikan Event untuk membantu saudara kita.</p>

        <!-- Container untuk card -->
        <div class="card-container d-flex gap-3" style="overflow-x: auto; scroll-snap-type: x mandatory;">
            <!-- Card 1 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <img src="/images/event/followed-event-1.svg" class="card-img-top" alt="Donasi Buku">
                <div class="event-card-spacer">
                    <div class="date-label bg-primary text-white event-date">
                        28 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer event-card-spacer">
                    <p class="card-title fw-bold h4">Donasi Buku untuk Pendidikan</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        04 Feb 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Yayasan Literasi Nusantara
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 08:00 - 15:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Surabaya, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-2.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="event-card-spacer">
                        <div class="date-label bg-primary text-white event-date">
                            02 Maret
                        </div>
                    </div>
                </div>
                <div class="event-details event-card-spacer event-card-spacer">
                    <p class="card-title fw-bold h4">Konser Musik untuk Harapan</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        10 Feb 25 | <a href="#" class="text-decoration-none category-color">Hiburan</a> | Author
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 18:00 - 22:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Jakarta, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-3.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        10 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Pameran Seni Amal</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        01 Jan 25 | <a href="#" class="text-decoration-none category-color">Hiburan</a> | Yayasan Seni Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 08:00 - 15:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Surabaya, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            {{-- <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-4.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        15 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Penggalangan Dana Virtual: Game Marathon</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        08 Feb 25 | <a href="#" class="text-decoration-none category-color">Hiburan</a> | Komunitas Gamer Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 18:00 - 06:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Online (Zoom)
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Card 5 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event//followed-event-4.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        21 Januari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Donor Darah Massal</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        20 Jan 25 | <a href="#" class="text-decoration-none category-color">Kesehatan</a> | Palang Merah Indonesia
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 08:00 - 021:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Yogyakarta, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-5.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        28 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Konser Amal untuk Anak Yatim</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        04 Feb 25 | <a href="#" class="text-decoration-none category-color">Sosial</a> | Komunitas Musik Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 18:00 - 21:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Yogyakarta, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-6.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        05 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Bazar Buku untuk Pendidikan</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        04 Feb 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Yayasan Buku Cerdas
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 10:00 - 19:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tambahkan Card 4, 5, dst dengan format serupa -->
        </div>
    </div>
</section>
<!-- End Followed Event -->

<!-- History Event -->
<section id="history-event" class="container py-2 mb-5">
    <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5  mx-md-5 px-2  mx-2 ">
        <h2 class="fw-bold">History yang pernah di ikuti</h2>
        <p class="text-muted">Semua progress anda akan disimpan dan menjadi langkah untuk mengubah dunia.</p>

        <!-- Container untuk card -->
        <div class="card-container d-flex gap-3" style="overflow-x: auto; scroll-snap-type: x mandatory;">
            <!-- Card 1 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/history-event-1.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        15 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Penggalangan Dana Virtual: Game Marathon</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        08 Feb 25 | <a href="#" class="text-decoration-none category-color">Hiburan</a> | Komunitas Gamer Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 18:00 - 06:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Online (Zoom)
                        </div>
                    </div>
                </div>
            </div>


            <!-- Card 2 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/history-event-2.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        10 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Pelatihan Relawan Bencana</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        04 Feb 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Yayasan Relawan Nusantara
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 09:00 - 15:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Bogor, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/history-event-3.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        30 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Seminar Bisnis Sosial</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        10 Feb 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Yayasan Inspirasi Bisnis
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 09:00 - 13:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Aula Inovasi, Surabaya
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/history-event-4.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        24 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Workshop Pemberdayaan UMKM</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        02 Jan 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Lembaga Bisnis Mandiri
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 09:00 - 16:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Coworking Space, Bali
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event//history-event-4.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        18 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Lomba Lari 5k untuk Kesehatan</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        15 Jan 25 | <a href="#" class="text-decoration-none category-color">Kesehatan</a> | Komunitas Sehat Bersama
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 06:00 - 09:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/history-event-5.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        10 Februari
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Pameran Seni Amal</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        01 Jan 25 | <a href="#" class="text-decoration-none category-color">Seni</a> | Yayasan Seni Peduli
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 10:00 - 18:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Galeri Nasional, Jakarta
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4" style="scroll-snap-align: start; width: 300px;">
                <div class="position-relative">
                    <img src="/images/event/followed-event-6.svg" class="card-img-top" alt="Donasi Buku">
                    <div class="date-label bg-primary text-white event-date">
                        05 Maret
                    </div>
                </div>
                <div class="event-details event-card-spacer">
                    <p class="card-title fw-bold h4">Bazar Buku untuk Pendidikan</p>
                    <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                        04 Feb 25 | <a href="#" class="text-decoration-none category-color">Edukasi</a> | Yayasan Buku Cerdas
                    </p>
                    <p class="card-text text-extra-small opacity-75 small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed...
                    </p>
                    <div class="card-text text-extra-small d-flex justify-content-between">
                        <div class="col-md-6">
                            <i class="fa-solid fa-clock"></i> 10:00 - 19:00 <br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa-solid fa-location-dot"></i> Bandung, Indonesia
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tambahkan Card 4, 5, dst dengan format serupa -->
        </div>
    </div>
</section>
<!-- End HistoryEvent -->

@endsection

@section('script')
<script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Toggle the type attribute
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });

        // Fungsi untuk membuka form input file saat tombol "Change Picture" diklik
        function showFileInput() {
            document.getElementById("fileInputContainer").style.display = "block"; // Menampilkan input file
        }
    </script>

    <script>
        // Fungsi untuk mengupload gambar profil
        function uploadProfilePicture() {
            const fileInput = document.getElementById("profilePictureInput");
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append("profile_image", file); // Sesuaikan nama field dengan controller
                formData.append("_method", "PUT"); // Laravel membutuhkan metode PUT
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').content); // CSRF token

                const url = "{{ route('profile.update', auth()->user()->id) }}"; // Route untuk update

                fetch(url, {
                        method: "POST", // Gunakan POST karena PUT dikirim dengan "_method"
                        body: formData,
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error("Upload failed");
                        }
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Gambar profil berhasil di-upload.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Refresh halaman setelah notifikasi ditutup
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengupload gambar.',
                        });
                        console.error(error);
                    });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Gambar',
                    text: 'Harap pilih gambar terlebih dahulu.',
                });
            }
        }
    </script>

    <script>
        function removeProfilePicture() {
            // Konfirmasi sebelum menghapus
            Swal.fire({
                title: 'Yakin ingin menghapus foto profil?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = "{{ route('profile.destroy', auth()->user()->id) }}"; // Route untuk destroy
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    fetch(url, {
                            method: "DELETE", // Gunakan metode DELETE
                            headers: {
                                "X-CSRF-TOKEN": csrfToken // CSRF token
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                return response.json().then(error => {
                                    throw new Error(error.error || "Failed to remove profile picture");
                                });
                            }
                        })
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Foto profil berhasil dihapus.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Refresh halaman setelah berhasil
                            });
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: error.message || 'Terjadi kesalahan saat menghapus foto profil.',
                            });
                        });
                }
            });
        }
    </script>
@endsection
