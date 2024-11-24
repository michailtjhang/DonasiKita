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
    height: auto; /* Default tinggi otomatis */
    min-height: 300px; /* Tambahkan tinggi minimum seragam */
}

.card-img-top {
    height: 150px;
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
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-align: left;
}

.card-text {
    font-size: 0.875rem;
    text-align: left;
    margin-bottom: 0.1rem;
    max-height: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-buttons {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 2.5px;
    font-size: 0.9rem;
}

.card-buttons button {
    border: none;
    background-color: transparent;
    color: #6cb6de;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    gap: 2.5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.hero-subtitle2 {
    white-space: nowrap;
    overflow: show;
    text-overflow: ellipsis;
}

.card-buttons button:hover {
    text-decoration: underline;
}

.card-buttons .divider {
    color: #ccc;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
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

#donation-cards .container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>
@endsection

@section('content')
<section class="hero-section2 w-100" style="background-image: url('/images/hero-bg-2.svg');">
    <div class="hero-overlay2"></div>
    <div class="hero-content2 text-left px-5 ms-5">
        <h1 class="hero-title2">Bencana</h1>
        <p class="hero-subtitle2">Blog > Category > Bencana</p>
    </div>
</section>

<div class="container my-4">
    <div class="Searchbar d-flex align-items-center mx-auto shadow" style="width: 600px; height: 50px; background: white; border-radius: 25px; overflow: hidden;">
        <input type="text" class="form-control border-0" placeholder="Ingin bantu siapa hari ini?" style="font-size: 16px; color: #B3B3B3; outline: none; flex: 1; padding-left: 20px;">
        <div class="search-icon-container" style="background: #6CB6DE; width: 90px; display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/donate/Vector.svg') }}" alt="Search Icon" style="width: 20px; height: 20px;">
        </div>
    </div>
</div>

<section id="blog-cards" class="my-5">
    <div class="container">
        <div class="container d-flex justify-content-between align-items-center my-4">
            <div>
                <h1 style="font-size: 30px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #0F3D56; margin-bottom: 5px;">
                    Blog
                </h1>
                <p style="font-size: 24px; font-weight: 400; font-family: 'Poppins', sans-serif; color: #0F3D56; line-height: 1.5;">
                    Menampilkan kategori "Bencana"
                </p>
            </div>
        </div>

        <div class="row" id="card-container"></div>
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
    { title: 'Kolaborasi untuk Korban Bencana', description: 'Kerja sama lintas komunitas membantu korban.', img: '/images/blog/cs1.svg', date: '18 Mar 25', category: 'Bencana', writer: 'Komunitas Relawan Bersatu' },
    { title: 'Gempa dan Psikologi Anak', description: 'Dukungan psikologis untuk anak korban gempa.', img: '/images/blog/cs2.svg', date: '12 Mar 25', category: 'Bencana', writer: 'Dina Suryani' },
    { title: 'Peringatan Dini Banjir', description: 'Teknologi untuk memantau risiko banjir.', img: '/images/blog/cs3.svg', date: '08 Mar 25', category: 'Bencana', writer: 'Tim Lingkungan' },
    { title: 'Cerita Relawan di Palu', description: 'Pengalaman relawan membantu korban bencana.', img: '/images/blog/cs4.svg', date: '02 Mar 25', category: 'Bencana', writer: 'Andi Firmansyah' },
    { title: 'Edukasi Mitigasi Gempa', description: 'Program edukasi kesiapsiagaan gempa.', img: '/images/blog/cs5.svg', date: '25 Feb 25', category: 'Bencana', writer: 'Tim Edukasi' },
    { title: 'Pentingnya Bantuan Logistik', description: 'Distribusi bantuan untuk korban bencana alam.', img: '/images/blog/cs6.svg', date: '20 Feb 25', category: 'Bencana', writer: 'Siti Rahmawati' },
    { title: 'Kesiapan Menghadapi Tsunami', description: 'Tips dan panduan untuk mengantisipasi bencana tsunami.', img: '/images/blog/cs7.svg', date: '15 Feb 25', category: 'Bencana', writer: 'Ahmad Fauzi' },
    { title: 'Penanganan Banjir Jakarta', description: 'Upaya membantu warga terdampak banjir.', img: '/images/blog/cs8.svg', date: '10 Feb 25', category: 'Bencana', writer: 'Tim Relawan' },
    { title: 'Bantu Korban Gempa Sulawesi', description: 'Donasi dan aksi cepat tanggap untuk korban gempa.', img: '/images/blog/cs9.svg', date: '04 Feb 25', category: 'Bencana', writer: 'Tim DonasiKita' },
    { title: 'Kolaborasi untuk Korban Bencana', description: 'Kerja sama lintas komunitas membantu korban.', img: '/images/blog/cs1.svg', date: '18 Mar 25', category: 'Bencana', writer: 'Komunitas Relawan Bersatu' },
    { title: 'Gempa dan Psikologi Anak', description: 'Dukungan psikologis untuk anak korban gempa.', img: '/images/blog/cs2.svg', date: '12 Mar 25', category: 'Bencana', writer: 'Dina Suryani' },
    { title: 'Peringatan Dini Banjir', description: 'Teknologi untuk memantau risiko banjir.', img: '/images/blog/cs3.svg', date: '08 Mar 25', category: 'Bencana', writer: 'Tim Lingkungan' },
    { title: 'Cerita Relawan di Palu', description: 'Pengalaman relawan membantu korban bencana.', img: '/images/blog/cs4.svg', date: '02 Mar 25', category: 'Bencana', writer: 'Andi Firmansyah' },
    { title: 'Edukasi Mitigasi Gempa', description: 'Program edukasi kesiapsiagaan gempa.', img: '/images/blog/cs5.svg', date: '25 Feb 25', category: 'Bencana', writer: 'Tim Edukasi' },
    { title: 'Pentingnya Bantuan Logistik', description: 'Distribusi bantuan untuk korban bencana alam.', img: '/images/blog/cs6.svg', date: '20 Feb 25', category: 'Bencana', writer: 'Siti Rahmawati' },
    { title: 'Kesiapan Menghadapi Tsunami', description: 'Tips dan panduan untuk mengantisipasi bencana tsunami.', img: '/images/blog/cs7.svg', date: '15 Feb 25', category: 'Bencana', writer: 'Ahmad Fauzi' },
    { title: 'Penanganan Banjir Jakarta', description: 'Upaya membantu warga terdampak banjir.', img: '/images/blog/cs8.svg', date: '10 Feb 25', category: 'Bencana', writer: 'Tim Relawan' },
    { title: 'Bantu Korban Gempa Sulawesi', description: 'Donasi dan aksi cepat tanggap untuk korban gempa.', img: '/images/blog/cs9.svg', date: '04 Feb 25', category: 'Bencana', writer: 'Tim DonasiKita' },
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
    if (currentPage > 1) {
        currentPage--;
        updatePagination();
    }
});

document.getElementById("next-page").addEventListener("click", () => {
    if (currentPage < Math.ceil(blogData.length / cardsPerPage)) {
        currentPage++;
        updatePagination();
    }
});

updatePagination();
</script>
@endsection
