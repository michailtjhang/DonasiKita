@extends('front.layout.app')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
    
    /* Pastikan ada container terpisah untuk masing-masing kartu */
    #history-card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>
@endsection

@section('content')
<div class="space-section"></div>

<div class="profile-container my-5 pt-5">
    <!-- Profile Image Section -->
    <div class="profile-image-container" onclick="openProfilePicturePopup()">
        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Profile Image" class="profile-image">
    </div>

    <!-- Profile Form Section -->
    <div class="form-container">
        <label for="name">Nama</label>
        <input type="text" id="name" value="John Doe" />

        <label for="email">Email</label>
        <input type="email" id="email" value="johndoe@example.com" />

    <div class="mb-0">
    <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password">
            <button class="btn btn-secondary" type="button" id="togglePassword">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </button>
        </div>
    </div>

        <!-- Button Section -->
        <div class="button-container">
            <button class="save-changes-button">Save Changes</button>
            <button class="change-password-button">Change Password</button>
            <button class="logout-button">Logout</button>
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

<!-- History Event -->
<div class="container mt-2">
    <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5 mx-md-5 px-2 mx-2 ">
        <h2 class="fw-bold">History Event</h2>
        <p class="text-muted">Semua progress anda akan disimpan dan menjadi langkah untuk mengubah dunia.</p>
        <!-- Wadah kartu untuk History Event -->
        <div id="history-card-container" class="row d-flex justify-content-center">
            <!-- Kartu akan dimuat di sini oleh JavaScript -->
        </div>

        <!-- Navigasi Slider -->
        <div class="pagination-container  my-5 pb-5">
            <button class="pagination-arrow" id="prev-history-page">&lt;</button>
            <div class="pagination-dots" id="history-pagination-dots"></div>
            <button class="pagination-arrow" id="next-history-page">&gt;</button>
        </div>
    </div>
</div>
<!-- End History Event -->
@endsection

@section('script')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script>
    // Data Kartu
    const cardsData = [{
            date: "21 Januari 2024",
            title: "Beragam acara seni, musik, dan pertunjukan kreatif yang bertujuan menggalang dana untuk mereka yang membutuhkan.",
            img: "/images/event/all-event-1.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Memberikan bantuan untuk korban bencana, kecelakaan, dan kemanusiaan lainnya.",
            img: "/images/event/all-event-2.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Masyarakat yang membutuhkan dengan pengawasan anak, bantuan kesejahteraan, dan program kemanusiaan.",
            img: "/images/event/all-event-3.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Meningkatkan kesehatan masyarakat dengan pengobatan, vaksinasi, dan perawatan medis.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Membantu korban bencana dengan pengungsian, pemberian makanan, dan perawatan medis.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Membantu anak-anak belajar dengan beasiswa, bantuan peralatan, dan program pendidikan.",
            img: "/images/event/all-event-6.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Beragam acara seni, musik, dan pertunjukan kreatif yang bertujuan menggalang dana untuk mereka yang membutuhkan.",
            img: "/images/event/all-event-6.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Memberikan bantuan untuk korban bencana, kecelakaan, dan kemanusiaan lainnya.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Masyarakat yang membutuhkan dengan pengawasan anak, bantuan kesejahteraan, dan program kemanusiaan.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Meningkatkan kesehatan masyarakat dengan pengobatan, vaksinasi, dan perawatan medis.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Membantu korban bencana dengan pengungsian, pemberian makanan, dan perawatan medis.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "21 Januari 2024",
            title: "Membantu anak-anak belajar dengan beasiswa, bantuan peralatan, dan program pendidikan.",
            img: "/images/event/all-event-1.svg"
        },
    ];

    // Variabel Halaman
    let currentPage = 1;
    const cardsPerPage = 3;

    // Fungsi untuk Menampilkan Kartu (Current/History Event)
    function renderCards(page, containerId) {
        const startIndex = (page - 1) * cardsPerPage;
        const visibleCards = cardsData.slice(startIndex, startIndex + cardsPerPage);

        const cardContainer = document.getElementById(containerId);
        cardContainer.innerHTML = ""; // Bersihkan kontainer

        visibleCards.forEach((card) => {
            cardContainer.innerHTML += `
                <div class="col-md-4 d-flex justify-content-center mt-4">
                <a class="text-light" href="{{url('/event_category_specific')}}">
                    <div class="event-card rounded rounded-5">
                        <img src="${card.img}" alt="Event Image" class="img-fluid">
                        <div class="event-date">${card.date}</div>
                        <div class="event-details pb-3 px-4">
                            <p class="event-title mb-3 fw-bold" style="font-size:14px !important">${card.title}</p>
                        </div>
                    </div>
                </a>
                </div>`;
        });
    }

    // Fungsi untuk Membuat Titik-Titik Paginasi
    function createPaginationDots(page, containerId) {
        const dotsContainer = document.getElementById(containerId);
        dotsContainer.innerHTML = ""; // Bersihkan elemen lama

        for (let i = 1; i <= Math.ceil(cardsData.length / cardsPerPage); i++) {
            const dot = document.createElement("div");
            dot.classList.add("pagination-dot");
            if (i === page) dot.classList.add("active");
            dot.addEventListener("click", () => {
                currentPage = i;
                updatePagination();
            });
            dotsContainer.appendChild(dot);
        }
    }

    // Fungsi untuk Memperbarui Halaman
    function updatePagination() {
        // Render untuk Current Event
        renderCards(currentPage, "current-card-container");
        createPaginationDots(currentPage, "pagination-dots");

        // Render untuk History Event
        renderCards(currentPage, "history-card-container");
        createPaginationDots(currentPage, "history-pagination-dots");
    }

    // Event Listener untuk Tombol Panah (Current Event)
    document.getElementById("prev-page").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    });

    document.getElementById("next-page").addEventListener("click", () => {
        if (currentPage < Math.ceil(cardsData.length / cardsPerPage)) {
            currentPage++;
            updatePagination();
        }
    });

    // Event Listener untuk Tombol Panah (History Event)
    document.getElementById("prev-history-page").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    });

    document.getElementById("next-history-page").addEventListener("click", () => {
        if (currentPage < Math.ceil(cardsData.length / cardsPerPage)) {
            currentPage++;
            updatePagination();
        }
    });

    // Inisialisasi Halaman
    updatePagination();

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

    // Fungsi untuk menghapus gambar profil
    function removeProfilePicture() {
        alert("Gambar profil telah dihapus.");
        // Anda bisa menambahkan logika untuk menghapus gambar disini
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

// Fungsi untuk mengupload gambar profil
function uploadProfilePicture() {
    const fileInput = document.getElementById("profilePictureInput");
    if (fileInput.files && fileInput.files[0]) {
        // Lakukan upload gambar sesuai dengan file yang dipilih
        alert("Gambar profil berhasil di-upload.");
        closeProfilePicturePopup(); // Tutup pop-up setelah upload
    } else {
        alert("Pilih gambar terlebih dahulu.");
    }
}

</script>
@endsection