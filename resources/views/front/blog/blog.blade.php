@extends('front.layout.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
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
    min-height: 300px;
}

.card-img-top {
    height: 150px; /* Sesuaikan tinggi gambar */
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
    font-weight: bold; /* Judul dibuat bold */
    margin-bottom: 0.5rem;
    text-align: left;
}

.card-text {
    font-size: 0.875rem;
    text-align: left;
    margin-bottom: 1rem;
    min-height: 40px; /* Tetapkan tinggi minimum untuk deskripsi */
    max-height: 80px; /* Batasi tinggi maksimum */
    overflow: hidden; /* Potong teks jika terlalu panjang */
    text-overflow: ellipsis; /* Tambahkan '...' jika teks dipotong */
}

/* Buttons for Date, Category, and Writer */
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

/* Divider for Buttons */
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
    background-color: white; /* Default background */
}

/* Hover Effect */
.see-all-categories:hover {
    background-color: #3498db; /* Change background to blue */
    color: white; /* Change text color to white */
}

/* Active/Onclick Effect */
.see-all-categories:active {
    background-color: #2874a6; /* Slightly darker blue */
    color: white;
    border-color: #2874a6; /* Adjust border color */
}

/* Pagination Styling */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px; /* Jarak antar tombol prev/next dan dots */
    margin-top: 20px;
}

.pagination-dots {
    display: flex;
    gap: 8px;
}

.pagination-dot {
    width: 12px;
    height: 12px;
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

/* Adjust Container */
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
        <h1 class="hero-title2">Blog</h1>
        <p class="hero-subtitle2">Temukan artikel inspiratif, tips, dan informasi terbaru tentang aksi kemanusiaan, lingkungan, kesehatan, dan hiburan yang mendukung kegiatan penggalangan dana.</p>
    </div>
</section>
<!-- End Hero Section -->

<!-- Search Bar -->
<div class="container my-4">
    <div class="Searchbar d-flex align-items-center mx-auto shadow" style="width: 600px; height: 50px; background: white; border-radius: 25px; overflow: hidden;">
        <input type="text" class="form-control border-0" placeholder="Ingin bantu siapa hari ini?" style="font-size: 16px; color: #B3B3B3; outline: none; flex: 1; padding-left: 20px;">
        <div class="search-icon-container" style="background: #6CB6DE; width: 90px; display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/donate/Vector.svg') }}" alt="Search Icon" style="width: 20px; height: 20px;">
        </div>
    </div>
</div>

<!-- Cards Section -->
<section id="blog-cards" class="my-5">
    <div class="container">
            <div class="container d-flex justify-content-between align-items-center my-4">
            <!-- Left Section: Blog Title and Description -->
            <div>
                <h1 style="font-size: 25px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #0F3D56; margin-bottom: 5px;">
                    Blog
                </h1>
                <p style="font-size: 18px; font-weight: 400; font-family: 'Poppins', sans-serif; color: #0F3D56; line-height: 1.5;">
                    Temukan berbagai Blog menarik yang mendukung misi kemanusiaan dan edukasi tentang bencana.
                </p>
            </div>

            <!-- Right Section: Button -->
            <div>
                <a href="{{ route('categories.index') }}" 
                class="see-all-categories" 
                id="categoriesButton">
                See All Categories
                </a>
             </div>
        </div>

        <div class="row" id="card-container">
            <!-- Dynamic Content -->
        </div>
        <!-- Pagination -->
        <div class="pagination-wrapper">
            <button class="pagination-arrow" id="prev-page">&lt;</button>
            <div class="pagination-dots" id="pagination-dots"></div>
            <button class="pagination-arrow" id="next-page">&gt;</button>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
const blogData = [
    {title: "Aksi Cepat Tanggap untuk Korban Banjir", description: "Mengulas aksi sosial dalam membantu korban banjir di daerah terdampak.", date: "04 Feb 25", category: "Kemanusiaan", writer: "Dafi Noniko", img: "/images/blog/1.svg"},
    {title: "Tips Kesiapsiagaan Menghadapi Gempa", description: "Panduan singkat untuk menjaga keselamatan saat terjadi gempa bumi.", date: "06 Feb 25", category: "Edukasi", writer: "Maya Fitriani", img: "/images/blog/2.svg"},
    {title: "Upaya Bersama untuk Menjaga Lingkungan", description: "Pentingnya kolaborasi komunitas untuk melindungi lingkungan.", date: "08 Feb 25", category: "Edukasi", writer: "Rudi Hartanto", img: "/images/blog/3.svg"},
    {title: "Donasi untuk Program Pendidikan Anak", description: "Cara berdonasi untuk membantu pendidikan anak-anak kurang mampu.", date: "10 Feb 25", category: "Kemanusiaan", writer: "Clara Widjaya", img: "/images/blog/4.svg"},
    {title: "Manfaat Kampanye Penghijauan Kota", description: "Dampak positif dari kampanye penghijauan di perkotaan.", date: "12 Feb 25", category: "Edukasi", writer: "Budi Santoso", img: "/images/blog/5.svg"},
    {title: "Kesehatan Mental di Tengah Krisis Bencana", description: "Pentingnya menjaga kesehatan mental saat menghadapi bencana.", date: "14 Feb 25", category: "Kesehatan", writer: "Sinta Amelia", img: "/images/blog/6.svg"},
    {title: "Relawan Muda dalam Aksi Sosial", description: "Kisah inspiratif relawan muda yang terjun membantu masyarakat.", date: "16 Feb 25", category: "Komunitas", writer: "Arif Wibowo", img: "/images/blog/7.svg"},
    {title: "Panduan Praktis Mengurangi Limbah Plastik", description: "Langkah sederhana untuk mengurangi penggunaan plastik.", date: "18 Feb 25", category: "Edukasi", writer: "Rini Kusuma", img: "/images/blog/8.svg"},
    {title: "Peran Komunitas dalam Pemulihan Pasca Bencana", description: "Bagaimana komunitas lokal membantu pemulihan daerah pasca-bencana.", date: "20 Feb 25", category: "Komunitas", writer: "Eka Putra", img: "/images/blog/9.svg"},
    {title: "Aksi Cepat Tanggap untuk Korban Banjir", description: "Mengulas aksi sosial dalam membantu korban banjir di daerah terdampak.", date: "04 Feb 25", category: "Kemanusiaan", writer: "Dafi Noniko", img: "/images/blog/1.svg"},
    {title: "Tips Kesiapsiagaan Menghadapi Gempa", description: "Panduan singkat untuk menjaga keselamatan saat terjadi gempa bumi.", date: "06 Feb 25", category: "Edukasi", writer: "Maya Fitriani", img: "/images/blog/2.svg"},
    {title: "Upaya Bersama untuk Menjaga Lingkungan", description: "Pentingnya kolaborasi komunitas untuk melindungi lingkungan.", date: "08 Feb 25", category: "Edukasi", writer: "Rudi Hartanto", img: "/images/blog/3.svg"},
    {title: "Donasi untuk Program Pendidikan Anak", description: "Cara berdonasi untuk membantu pendidikan anak-anak kurang mampu.", date: "10 Feb 25", category: "Kemanusiaan", writer: "Clara Widjaya", img: "/images/blog/4.svg"},
    {title: "Manfaat Kampanye Penghijauan Kota", description: "Dampak positif dari kampanye penghijauan di perkotaan.", date: "12 Feb 25", category: "Edukasi", writer: "Budi Santoso", img: "/images/blog/5.svg"},
    {title: "Kesehatan Mental di Tengah Krisis Bencana", description: "Pentingnya menjaga kesehatan mental saat menghadapi bencana.", date: "14 Feb 25", category: "Kesehatan", writer: "Sinta Amelia", img: "/images/blog/6.svg"},
    {title: "Relawan Muda dalam Aksi Sosial", description: "Kisah inspiratif relawan muda yang terjun membantu masyarakat.", date: "16 Feb 25", category: "Komunitas", writer: "Arif Wibowo", img: "/images/blog/7.svg"},
    {title: "Panduan Praktis Mengurangi Limbah Plastik", description: "Langkah sederhana untuk mengurangi penggunaan plastik.", date: "18 Feb 25", category: "Edukasi", writer: "Rini Kusuma", img: "/images/blog/8.svg"},
    {title: "Peran Komunitas dalam Pemulihan Pasca Bencana", description: "Bagaimana komunitas lokal membantu pemulihan daerah pasca-bencana.", date: "20 Feb 25", category: "Komunitas", writer: "Eka Putra", img: "/images/blog/9.svg"}
];

let currentPage = 1;
const cardsPerPage = 9;

function renderCards(page) {
    const startIndex = (page - 1) * cardsPerPage;
    const visibleCards = blogData.slice(startIndex, startIndex + cardsPerPage);

    const cardsContainer = document.getElementById("card-container");
    cardsContainer.innerHTML = "";

    visibleCards.forEach(card => {
        cardsContainer.innerHTML += `
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="donation-card">
                    <img src="${card.img}" class="card-img-top" alt="${card.title}">
                    <div class="card-body">
                        <h5 class="card-title">${card.title}</h5>
                        <p class="card-text">${card.description}</p>
                        <div class="card-buttons">
                            <button>${card.date}</button>
                            <span class="divider">|</span>
                            <button>${card.category}</button>
                            <span class="divider">|</span>
                            <button>Oleh ${card.writer}</button>
                        </div>
                    </div>
                </div>
            </div>`;
    });
}

function updatePagination() {
    const dotsContainer = document.getElementById("pagination-dots");
    dotsContainer.innerHTML = "";

    for (let i = 1; i <= Math.ceil(blogData.length / cardsPerPage); i++) {
        const dot = document.createElement("div");
        dot.className = "pagination-dot" + (i === currentPage ? " active" : "");
        dot.addEventListener("click", () => {
            currentPage = i;
            updatePagination();
        });
        dotsContainer.appendChild(dot);
    }

    renderCards(currentPage);
}

document.getElementById("prev-page").addEventListener("click", () => {
    currentPage = currentPage > 1 ? currentPage - 1 : Math.ceil(blogData.length / cardsPerPage);
    updatePagination();
});

document.getElementById("next-page").addEventListener("click", () => {
    currentPage = currentPage < Math.ceil(blogData.length / cardsPerPage) ? currentPage + 1 : 1;
    updatePagination();
});

// Initial rendering
updatePagination();
</script>
@endsection
