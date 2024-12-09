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
            cursor: pointer;
            /* Menambahkan cursor pointer untuk menunjukkan interaksi */
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
            display: none;
            /* Pop-up disembunyikan secara default */
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

        .change-password-button,
        .logout-button {
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

        .change-password-button:hover,
        .logout-button:hover {
            background-color: #f1f1f1;
        }

        .category-color {
            color: #ffffff;
            /* Warna putih */
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
    <div class="space-section"></div>

    <div class="d-flex justify-content-center align-items-center mx-lg-5 px-md-5  mx-md-5 px-2  mx-2">
        <div class="card rounded rounded-5 spacer-x p-5 my-5 pt-5">
            <div class="row g-4">
                <!-- Profile Image Section -->
                <div class="col-lg-4 text-center" onclick="openProfilePicturePopup()">
                    <img src="{{ auth()->user()->media ? auth()->user()->media->cloudinary_url : 'https://www.w3schools.com/w3images/avatar2.png' }}"
                        alt="Profile Image" class="profile-image img img-fluid rounded-circle">
                </div>

                <!-- Profile Form Section -->
                <div class="col-lg-8">
                    @include('_message')

                    <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST"
                        class="needs-validation">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                class="form-control @error('name') is-invalid @enderror" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                class="form-control @error('email') is-invalid @enderror" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter your password">
                                <button class="btn btn-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex">
                            <button type="submit" class="save-changes-button me-2">Save Changes</button>
                            <a href="{{ route('logout') }}" class="logout-button">Logout</a>
                        </div>
                    </form>
                </div>
            </div>
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

    <!-- Followed Event -->
    <section id="folowed-event" class="container pt-2 mb-5">
        <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5  mx-md-5 px-2  mx-2 ">
            <h2 class="fw-bold">Event yang Diikuti</h2>
            <p class="text-muted">Selesaikan Event untuk membantu saudara kita.</p>

            <!-- Container untuk card -->
            <div class="card-container d-flex gap-3" style="overflow-x: auto; scroll-snap-type: x mandatory;">
                @forelse ($futureEvents as $registration)
                    <!-- Card 1 -->
                    <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                        style="scroll-snap-align: start; width: 300px;">
                        <img src="{{ $registration->event->thumbnail ? $registration->event->thumbnail->file_path : '/images/event/followed-event-1.svg' }}"
                            class="card-img-top" alt="Donasi Buku">
                        <div class="event-card-spacer">
                            <div class="date-label bg-primary text-white event-date">
                                {{ \Carbon\Carbon::parse($registration->event->detailEvent->start)->format('d F') }}
                            </div>
                        </div>
                        <div class="event-details event-card-spacer event-card-spacer">
                            <p class="card-title fw-bold h4">{{ $registration->event->title }}</p>
                            <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                                {{ \Carbon\Carbon::parse($registration->event->detailEvent->start)->format('d F Y') }} | <a
                                    href="/events?category={{ $registration->event->category->slug }}"
                                    class="text-decoration-none category-color">{{ $registration->event->category->name }}</a>
                            </p>
                            <p class="card-text text-extra-small opacity-75 small">
                                {{ Str::limit(strip_tags($registration->event->description), 50, '...') }}
                            </p>
                            <div class="card-text text-extra-small d-flex justify-content-between">
                                <div class="col-md-6">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ $registration->event->detailEvent->start->format('H:i') }} -
                                    {{ $registration->event->detailEvent->end->format('H:i') }} <br>
                                </div>
                                <div class="col-md-6">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $registration->event->location->name_location }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <p class="fw-bold text-primary">Belum ada event yang diikuti</p>
                    </div>
                @endforelse
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
                @forelse ($pastEvents as $registration)
                    <!-- Card 1 -->
                    <div class="event-card-short flex-shrink-0 rounded rounded-5 shadow-sm mb-4"
                        style="scroll-snap-align: start; width: 300px;">
                        <div class="position-relative">
                            <img src="/images/event/history-event-1.svg" class="card-img-top" alt="Donasi Buku">
                            <div class="date-label bg-primary text-white event-date">
                                {{ \Carbon\Carbon::parse($registration->event->detailEvent->start)->format('d F') }}
                            </div>
                        </div>
                        <div class="event-details event-card-spacer">
                            <p class="card-title fw-bold h4">{{ $registration->event->title }}</p>
                            <p class="card-text fw-thin text-extra-small opacity-75 p-0 m-0">
                                {{ \Carbon\Carbon::parse($registration->event->detailEvent->end)->format('d F Y') }} | <a
                                    href="/events?category={{ $registration->event->category->slug }}"
                                    class="text-decoration-none category-color">{{ $registration->event->category->name }}</a>
                            </p>
                            <p class="card-text text-extra-small opacity-75 small">
                                {{ Str::limit(strip_tags($registration->event->description), 50, '...') }}
                            </p>
                            <div class="card-text text-extra-small d-flex justify-content-between">
                                <div class="col-md-6">
                                    <i class="fa-solid fa-clock"></i> {{ $registration->event->detailEvent->start->format('H:i') }} - {{ $registration->event->detailEvent->end->format('H:i') }} <br>
                                </div>
                                <div class="col-md-6">
                                    <i class="fa-solid fa-location-dot"></i> {{ $registration->event->location->name_location }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <p class="fw-bold text-primary">Belum ada event yang pernah diikuti</p>
                    </div>
                @endforelse

                <!-- Tambahkan Card 4, 5, dst dengan format serupa -->
            </div>
        </div>
    </section>
    <!-- End HistoryEvent -->
@endsection

@section('script')
    <script>
        // Fungsi untuk membuka Pop-up
        function openProfilePicturePopup() {
            document.getElementById("profilePicturePopup").style.display = "flex"; // Menampilkan pop-up
        }

        // Fungsi untuk menutup Pop-up
        function closeProfilePicturePopup() {
            document.getElementById("profilePicturePopup").style.display = "none"; // Menyembunyikan pop-up
        }

        // Fungsi untuk mengedit gambar profil
        function editProfilePicture() {
            alert("Fitur untuk mengedit gambar profil belum tersedia.");
            // Anda bisa menambahkan logika upload gambar baru disini
            closeProfilePicturePopup();
        }

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
            const uploadButton = document.querySelector("button[onclick='uploadProfilePicture()']");
            const file = fileInput.files[0];

            // Menonaktifkan tombol "Upload" dan menutup pop-up saat upload dimulai
            uploadButton.disabled = true; // Menonaktifkan tombol upload
            closeProfilePicturePopup(); // Menutup pop-up segera setelah tombol "Upload" diklik

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
                    })
                    .finally(() => {
                        uploadButton.disabled = false; // Mengaktifkan kembali tombol upload
                    });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Gambar',
                    text: 'Harap pilih gambar terlebih dahulu.',
                });
                uploadButton.disabled = false; // Mengaktifkan kembali tombol upload jika file tidak dipilih
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
