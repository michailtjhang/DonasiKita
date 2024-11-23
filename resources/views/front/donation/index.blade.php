@extends('front.layout.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
<style>

/* Cards Styling */
.donation-card {
    border-radius: 15px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 0.875rem;
}

.progress {
    height: 8px;
    border-radius: 4px;
    background-color: #f0f0f0;
}

.progress-bar {
    background-color: #3498db;
}

.card-img-top {
    max-height: 180px;
    object-fit: cover;
    border-bottom: 1px solid #e0e0e0;
}

.card-body {
    padding: 1rem;
}

.text-muted {
    font-size: 0.75rem;
    color: #7d7d7d;
}

/* Pagination Styling */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 10px;
}

.pagination-dots {
    display: flex;
    gap: 8px;
    align-items: center;
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

.pagination-arrow {
    width: 35px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: none;
    background-color: #bbddf0;
    color: #0f3d56;
    font-size: 18px;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.pagination-arrow:hover {
    background-color: #a9cce3;
}

.pagination-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
    <div class="hero-overlay2"></div>
    <div class="hero-content2 text-left px-5 ms-5">
        <h1 class="hero-title2">Donation</h1>
        <p class="hero-subtitle2">Salurkan bantuan anda, dengan menyumbang mulai dari Rp1000</p>
    </div>
</section>
<!-- End Hero Section -->
    
<!-- Search Bar -->
<div class="container my-4">
    <div 
        class="Searchbar d-flex align-items-center mx-auto shadow" 
        style="
            width: 600px; 
            height: 50px; 
            background: white; 
            border-radius: 25px; 
            overflow: hidden; 
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">
        
        <!-- Input Field -->
        <input 
            type="text" 
            class="form-control border-0" 
            placeholder="Ingin bantu siapa hari ini?" 
            style="
                font-size: 16px; 
                color: #B3B3B3; 
                outline: none; 
                box-shadow: none; 
                height: 100%; 
                flex: 1; 
                padding-left: 20px;">
        
        <!-- Search Icon Background -->
        <div 
            class="search-icon-container" 
            style="
                background: #6CB6DE; 
                width: 90px; 
                height: 100%; 
                border-top-right-radius: 25px; 
                border-bottom-right-radius: 25px; 
                display: flex; 
                align-items: center; 
                justify-content: center;">
            
            <!-- Search Icon -->
            <img 
                src="{{ asset('images/donate/Vector.svg') }}" 
                alt="Search Icon" 
                style="width: 20px; height: 20px;">
        </div>
    </div>
</div>

<!-- Cards Section -->
<section id="donation-cards" class="my-5">
    <div class="container">
        <div class="row">
            <!-- Cards will be rendered dynamically -->
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-4">
            <button class="pagination-arrow" id="prev-page">&lt;</button>
            <div class="pagination-dots" id="pagination-dots"></div>
            <button class="pagination-arrow" id="next-page">&gt;</button>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
const cardsData = [
    { title: "Bantu Pendidikan Anak Pedalaman", category: "Yayasan Anak Nusantara", target: "Rp 50.000.000", collected: "Rp 5.550.000", donors: "285 Donatur", daysLeft: "50 Hari Lagi", img: "/images/donate/1.svg" },
    { title: "Aksi Bencana Alam untuk Korban Gempa", category: "Komunitas Peduli Sesama", target: "Rp 100.000.000", collected: "Rp 10.050.000", donors: "598 Donatur", daysLeft: "41 Hari Lagi", img: "/images/donate/2.svg" },
    { title: "Renovasi Masjid di Pelosok Negeri", category: "Yayasan Cahaya Iman", target: "Rp 150.000.000", collected: "Rp 37.500.000", donors: "320 Donatur", daysLeft: "32 Hari Lagi", img: "/images/donate/4.svg" },
    { title: "Operasi Gratis untuk Penderita Bibir Sumbing", category: "Komunitas Senyuman Baru", target: "Rp 400.000.000", collected: "Rp 100.000.000", donors: "190 Donatur", daysLeft: "44 Hari Lagi", img: "/images/donate/5.svg" },
    { title: "Kursi Roda untuk Penyandang Disabilitas", category: "Yayasan Sahabat Difabel", target: "Rp 50.000.000", collected: "Rp 12.500.000", donors: "50 Donatur", daysLeft: "28 Hari Lagi", img: "/images/donate/7.svg" },
    { title: "Air Bersih untuk Daerah Terdampak Kekeringan", category: "Lembaga Air untuk Kehidupan", target: "Rp 300.000.000", collected: "Rp 75.000.000", donors: "300 Donatur", daysLeft: "40 Hari Lagi", img: "/images/donate/8.svg" },
    { title: "Makanan untuk Anak Yatim", category: "Komunitas Kasih Anak Yatim", target: "Rp 100.000.000", collected: "Rp 25.000.000", donors: "92 Donatur", daysLeft: "22 Hari Lagi", img: "/images/donate/9.svg" }
];

let currentPage = 1;
const cardsPerPage = 3;

function renderCards(page) {
    const startIndex = (page - 1) * cardsPerPage;
    const visibleCards = cardsData.slice(startIndex, startIndex + cardsPerPage);

    const cardsContainer = document.querySelector("#donation-cards .row");
    cardsContainer.innerHTML = "";

    visibleCards.forEach(card => {
        cardsContainer.innerHTML += `
            <div class="col-md-4 mb-4">
                <div class="donation-card">
                    <img src="${card.img}" class="card-img-top" alt="${card.title}">
                    <div class="card-body">
                        <h5 class="card-title">${card.title}</h5>
                        <p class="card-text text-muted">${card.category}</p>
                        <div class="progress my-3">
                            <div class="progress-bar" role="progressbar" style="width: ${(parseInt(card.collected.replace(/Rp|\.|,/g, '')) / parseInt(card.target.replace(/Rp|\.|,/g, ''))) * 100}%"></div>
                        </div>
                        <p class="card-text"><strong>${card.collected}</strong> / ${card.target}</p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">${card.donors}</small>
                            <small class="text-muted">${card.daysLeft}</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
}

function updatePagination() {
    const dotsContainer = document.getElementById("pagination-dots");
    dotsContainer.innerHTML = "";

    for (let i = 1; i <= Math.ceil(cardsData.length / cardsPerPage); i++) {
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

updatePagination();
</script>
@endsection
