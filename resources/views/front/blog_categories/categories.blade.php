@extends('front.layout.app')

@section('style')
<style>
/* Styling untuk kategori */
.card-category {
    background: #F8FCFF;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card-category:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-category img {
    width: 100%;
    height: 221px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-category h3 {
    font-size: 24px;
    font-weight: 700;
    color: #0F3D56;
    margin: 10px 0 5px;
    text-align: center;
}

.card-category p {
    font-size: 16px;
    color: #2185BB;
    line-height: 1.5;
    padding: 0 15px 15px;
    text-align: left;
}

.categories-title {
    color: #0F3D56;
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
}

.categories-subtitle {
    color: #0F3D56;
    font-size: 18px;
    margin-bottom: 30px;
}

.searchbar-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 120px auto 40px; /* Margin atas cukup untuk menghindari tertutup header */
}

.searchbar-input {
    width: 600px;
    height: 50px;
    padding: 0 20px;
    font-size: 16px;
    color: #B3B3B3;
    border: none;
    border-radius: 25px 0 0 25px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.searchbar-input:focus {
    outline: none;
}

.search-icon-container {
    background: #6CB6DE;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0 25px 25px 0;
    padding: 0 15px;
    cursor: pointer;
}

.search-icon-container img {
    width: 20px;
    height: 20px;
}

</style>
@endsection

@section('content')

<!-- Categories Section -->
<div class="container mt-5">

    <!-- search bar -->
    <div class="container">
        <div class="searchbar-container">
            <input 
                type="text" 
                class="searchbar-input" 
                placeholder="Ingin bantu siapa hari ini?">
            <div class="search-icon-container">
                <img src="{{ asset('images/donate/Vector.svg') }}" alt="Search Icon" class="search-icon">
            </div>
        </div>
    </div>

    <!-- Header Kategori -->
    <div class="text-left">
        <h1 class="categories-title">Blog Categories</h1>
        <p class="categories-subtitle">All Blog Category</p>
    </div>

    <!-- Kartu Kategori -->
    <div class="row">
        @foreach([
            ['title' => 'Kemanusiaan', 'description' => 'Artikel tentang aksi sosial, cerita inspiratif, dan upaya membantu sesama yang membutuhkan.', 'img' => 'c-1.svg'],
            ['title' => 'Bencana', 'description' => 'Informasi terkini dan panduan menghadapi serta menangani dampak bencana alam.', 'img' => 'c-2.svg'],
            ['title' => 'Edukasi', 'description' => 'Konten yang mendukung pemberdayaan masyarakat melalui program pendidikan dan pelatihan.', 'img' => 'c-3.svg'],
            ['title' => 'Kesehatan', 'description' => 'Tips menjaga kesehatan, panduan hidup sehat, dan kegiatan untuk mendukung kesejahteraan masyarakat.', 'img' => 'c-4.svg'],
            ['title' => 'Lingkungan', 'description' => 'Kisah inspiratif dan aksi nyata untuk pelestarian alam, penghijauan, dan keberlanjutan.', 'img' => 'c-5.svg'],
            ['title' => 'Komunitas', 'description' => 'Cerita dan kegiatan inspiratif dari komunitas lokal yang berkolaborasi untuk menciptakan dampak positif.', 'img' => 'c-6.svg']
        ] as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card-category">
                <img src="{{ asset('images/blog/' . $category['img']) }}" alt="{{ $category['title'] }}">
                <h3>{{ $category['title'] }}</h3>
                <p>{{ $category['description'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection