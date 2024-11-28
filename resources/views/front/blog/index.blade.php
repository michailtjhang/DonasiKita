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
            min-height: 270px;
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
            margin-bottom: 1rem;
            min-height: 40px;
            max-height: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

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
            background-color: white;
        }

        .see-all-categories:hover {
            background-color: #3498db;
            color: white;
        }

        .see-all-categories:active {
            background-color: #2874a6;
            color: white;
            border-color: #2874a6;
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
            <h1 class="hero-title2">Blog</h1>
            <p class="hero-subtitle2">Temukan artikel inspiratif, tips, dan informasi terbaru tentang aksi kemanusiaan,
                lingkungan, kesehatan, dan hiburan yang mendukung kegiatan penggalangan dana.</p>
        </div>
    </section>

    <div class="container my-4">
        <form>
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="Searchbar d-flex align-items-center mx-auto shadow"
                style="width: 600px; height: 50px; background: white; border-radius: 25px; overflow: hidden;">
                <input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control border-0"
                    placeholder="Ingin search apa hari ini?"
                    style="font-size: 16px; color: #B3B3B3; outline: none; flex: 1; padding-left: 20px;" autocomplete="off">
                <button class="search-icon-container border-0" type="submit" 
                    style="background: #6CB6DE; width: 90px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('images/donate/Vector.svg') }}" alt="Search Icon" style="width: 20px; height: 20px;">
                </button>
            </div>
        </form>
    </div>

    <section id="blog-cards" class="my-5">
        <div class="container">
            <div class="container d-flex justify-content-between align-items-center my-4">
                <div>
                    <h1
                        style="font-size: 25px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #0F3D56; margin-bottom: 5px;">
                        Blog
                    </h1>
                    <p
                        style="font-size: 18px; font-weight: 400; font-family: 'Poppins', sans-serif; color: #0F3D56; line-height: 1.5;">
                        Temukan berbagai Blog menarik yang mendukung misi kemanusiaan dan edukasi tentang bencana.
                    </p>
                </div>
                <a href="{{ route('blogs.categories') }}" class="see-all-categories" id="categoriesButton">
                    See All Categories
                </a>
            </div>

            <div class="row" id="card-container">
                @forelse ($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('blog.show', $article->slug) }}">
                                @if ($article->thumbnail && $article->thumbnail->file_path)
                                    <img src="{{ asset('storage/cover/' . $article->thumbnail->file_path) }}" 
                                         class="card-img-top img-fluid" 
                                         alt="{{ $article->title }}">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                                         style="height: 200px;">
                                        <span>No cover image available</span>
                                    </div>
                                @endif
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="text-dark text-decoration-none">
                                        {{ $article->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">{{ Str::limit(strip_tags($article->content), 100, '...') }}</p>
                                <div class="d-flex flex-wrap gap-1 align-items-center mt-3">
                                    <small class="text-muted">{{ $article->created_at->format('d M Y') }}</small>
                                    <span class="text-muted mx-1">|</span>
                                    <a href="/blogs?category={{ $article->category->slug }}" 
                                       class="text-muted text-decoration-none">
                                        {{ $article->category->name }}
                                    </a>
                                    <span class="text-muted mx-1">|</span>
                                    <small class="text-muted">Oleh {{ $article->user->name ?? 'Anonim' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <p class="text-center font-weight-bold">Tidak ada artikel yang ditemukan.</p>
                @endforelse
            </div>
            
            <div class="pagination-wrapper">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection
