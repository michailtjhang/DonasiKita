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
        <h1 class="hero-title2">Event Category</h1>
        <p class="hero-subtitle2-event">Event > Category</p>
    </div>
</section>
<!-- End Hero Section -->

<!-- Search Bar -->
<section id="search-bar" style="background-color: #eaf4fc; display: flex; justify-content: center; align-items: center; height:40vh">
    <div class="search-container d-flex justify-content-center align-items-center">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="ingin cari event apa hari ini?">
            <button class="btn search-btn" type="button">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</section>
<!-- End Search Bar -->

<!-- Kategori Event -->
<div class="container mt-5">
    <div class="row justify-content-center px-lg-5 mx-lg-5 px-md-5  mx-md-5 px-2  mx-2 ">
        <h2 class="fw-bold">Event Categories</h2>
        <p class="text-muted">All Event Category</p>
        <!-- Wadah kartu -->
        <div id="card-container" class="row d-flex justify-content-center">
            <!-- Kartu akan dimuat di sini oleh JavaScript -->
        </div>

        <!-- Navigasi Slider -->
        <div class="pagination-container  my-5">
            <button class="pagination-arrow" id="prev-page">&lt;</button>
            <div class="pagination-dots" id="pagination-dots"></div>
            <button class="pagination-arrow" id="next-page">&gt;</button>
        </div>
    </div>
</div>


<!-- End Kategori Event -->

@endsection


@section('script')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script>
    // Data Kartu
    const cardsData = [{
            date: "Hiburan",
            title: "Beragam acara seni, musik, dan pertunjukan kreatif yang bertujuan menggalang dana untuk mereka yang membutuhkan.",
            img: "/images/event/all-event-1.svg"
        },
        {
            date: "Kemanusiaan",
            title: "Memberikan bantuan untuk korban bencana, kecelakaan, dan kemanusiaan lainnya.",
            img: "/images/event/all-event-2.svg"
        },
        {
            date: "Sosial",
            title: "Masyarakat yang membutuhkan dengan pengawasan anak, bantuan kesejahteraan, dan program kemanusiaan.",
            img: "/images/event/all-event-3.svg"
        },
        {
            date: "Kesehatan",
            title: "Meningkatkan kesehatan masyarakat dengan pengobatan, vaksinasi, dan perawatan medis.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "Bencana",
            title: "Membantu korban bencana dengan pengungsian, pemberian makanan, dan perawatan medis.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "Edukasi",
            title: "Membantu anak-anak belajar dengan beasiswa, bantuan peralatan, dan program pendidikan.",
            img: "/images/event/all-event-6.svg"
        },

        {
            date: "Hiburan",
            title: "Beragam acara seni, musik, dan pertunjukan kreatif yang bertujuan menggalang dana untuk mereka yang membutuhkan.",
            img: "/images/event/all-event-6.svg"
        },
        {
            date: "Kemanusiaan",
            title: "Memberikan bantuan untuk korban bencana, kecelakaan, dan kemanusiaan lainnya.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "Sosial",
            title: "Masyarakat yang membutuhkan dengan pengawasan anak, bantuan kesejahteraan, dan program kemanusiaan.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "Kesehatan",
            title: "Meningkatkan kesehatan masyarakat dengan pengobatan, vaksinasi, dan perawatan medis.",
            img: "/images/event/all-event-4.svg"
        },
        {
            date: "Bencana",
            title: "Membantu korban bencana dengan pengungsian, pemberian makanan, dan perawatan medis.",
            img: "/images/event/all-event-5.svg"
        },
        {
            date: "Edukasi",
            title: "Membantu anak-anak belajar dengan beasiswa, bantuan peralatan, dan program pendidikan.",
            img: "/images/event/all-event-1.svg"
        },
    ];

    // Variabel Halaman
    let currentPage = 1;
    const cardsPerPage = 6;

    // Fungsi untuk Menampilkan Kartu
    function renderCards(page) {
        const startIndex = (page - 1) * cardsPerPage;
        const visibleCards = cardsData.slice(startIndex, startIndex + cardsPerPage);

        const cardContainer = document.getElementById("card-container");
        cardContainer.innerHTML = ""; // Bersihkan kontainer

        visibleCards.forEach((card) => {
            cardContainer.innerHTML += `
                <div class="col-md-4 d-flex justify-content-center mt-4">
                    <div class="event-card rounded rounded-5">
                        <img src="${card.img}" alt="Event Image" class="img-fluid">
                        <div class="event-date">${card.date}</div>
                        <div class="event-details pb-3 px-4">
                            <p class="event-title  mb-3 fw-bold" style="font-size:14px !important">${card.title}</p>
                        </div>
                    </div>
                </div>`;
        });
    }

    // Fungsi untuk Membuat Titik-Titik Paginasi
    function createPaginationDots() {
        const dotsContainer = document.getElementById("pagination-dots");
        dotsContainer.innerHTML = ""; // Bersihkan elemen lama

        for (let i = 1; i <= Math.ceil(cardsData.length / cardsPerPage); i++) {
            const dot = document.createElement("div");
            dot.classList.add("pagination-dot");
            if (i === currentPage) dot.classList.add("active");
            dot.addEventListener("click", () => {
                currentPage = i;
                updatePagination();
            });
            dotsContainer.appendChild(dot);
        }
    }

    // Fungsi untuk Memperbarui Halaman
    function updatePagination() {
        renderCards(currentPage); // Render kartu
        createPaginationDots(); // Perbarui navigasi titik
    }

    // Event Listener untuk Tombol Panah
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

    // Inisialisasi
    updatePagination();
</script>
@endsection