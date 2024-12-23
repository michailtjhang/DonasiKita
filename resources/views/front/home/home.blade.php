@extends('front.layout.app')

@section('seoMeta')
<!-- Meta tags for SEO -->
<meta name="description"
    content="{{ $config['meta_description'] }}">
<meta name="keywords"
    content="{{ $config['meta_keywords'] }}">
<meta name="author" content="{{ config('app.name', 'DonasiKita') }} Team">

<!-- Open Graph Meta Tags for social media sharing -->
<meta property="og:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
<meta property="og:description"
    content="{{ $config['meta_description'] }}">
<meta property="og:image" content="{{ $config['logo'] ?? asset('images/logo-navbar.svg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:title" content="{{ $page_title ?? 'HomePage' }} | {{ config('app.name', 'DonasiKita') }}">
<meta name="twitter:description"
    content="{{ $config['meta_description'] }}">
<meta name="twitter:image" content="{{ $config['logo'] ?? asset('images/logo-navbar.svg') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- Additional Meta Tags -->
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
@endsection

@section('style')
<style>
    .accordion-button::after {
        content: '';
        display: inline-block;
        width: 3.5rem !important;
        height: 3.5rem !important;
        background-image: url('/images/button_faq.svg') !important;
        /* Path ke ikon Anda */
        background-size: 100% !important;
        background-repeat: no-repeat;
        background-position: center;
        transition: transform 0.3s ease;
    }

    /* Rotasi ketika accordion dibuka */
    .accordion-button:not(.collapsed)::after {
        transform: rotate(90deg) !important;
    }

    .accordion-rounded {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .accordion-header {

        border-radius: 30px !important;
    }

    /* Styling tambahan */
    .accordion-button {
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .accordion-button:focus,
    .accordion-button:not(.collapsed) {
        background-color: transparent !important;
        /* Pastikan tidak berubah saat fokus atau aktif */
        color: inherit !important;
        /* Warna teks tetap */
        box-shadow: none !important;
        /* Hilangkan efek outline */
    }

    .accordion-body-custom {
        background-color: #f8fcff;
        color: #0f3d56;
        /* border: 1px solid #0f3d56;
            border-radius: 5px; */
    }

    .accordion-teks-custom {
        color: #0f3d56 !important;
    }

    #accordion img {
        height: 300px;
        /* Tetapkan tinggi maksimum */
        object-fit: contain;
        /* Menjaga proporsi gambar */
    }

    /* .accordion-button:hover {
            color: #084298;
        } */
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div id="carouselExampleControls" class="carousel slide space-section" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($content['hero_section']['carousel'] as $key => $item)
        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
            <div class="hero-section d-flex align-items-center justify-content-center text-center"
                style="background-image: url('{{ $item['image'] }}'); height:90vh;">
                <div class="spacer-x">
                    <h1 class="hero-title bolder-text display-4">{{ $item['title'] }}</h1>
                    <p class="lead">{{ $item['subtitle'] }}</p>
                    <div class="text-center">
                        <a href="{{ $item['button_link'] }}" class="btn btn-primary"
                            style="margin: 6px; padding: 10px 20px;">
                            <h3>@lang('messages.hero_title')</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- End Hero Section -->
<!-- About Content Section -->
<section id="about-content" class="space-section">
    <div class="container-fluid py-5 justify-content-center text-center bg-skyline">
        <h1 class="bolder-text text-dark" style="margin-bottom: 50px">{{ $content['about_section']['title'] }}</h1>
        <div class="row mx-auto text-wrap" style="width:80%;">
            <div class="col-lg-6 col-12">
                <img src="{{ $content['about_section']['image'] }}" class="about-image img-fluid" alt="">
            </div>
            <div class="col-lg-6 col-12 text-dark d-flex  px-5">
                <p class="text-large-responsive" style="text-align:left">
                    {!! $content['about_section']['description'] !!}
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End About Content Section -->

<!-- Donate Content Section -->
<section id="donate-content" class="bg-skyline space-section">
    <div class="container d-flex justify-content-center bg-skyline ">

        <div class="row justify-content-center align-items-center">
            <div class="row mx-2">
                <h3 class="fw-bold">Donation</h3>
                <div class="d-flex flex-wrap align-items-center pb-2">
                    <!-- Paragraf -->
                    <p class="text-muted mb-2 flex-grow-1 col-12 col-lg-10">
                        @lang('messages.donate_message')
                    </p>
                    <!-- Tombol -->
                    <a href="{{ route('donations') }}" class="btn rounded rounded-5 fw-light col-4 col-lg-2"
                        style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">
                        @lang('messages.see_more')
                    </a>
                </div>
            </div>

            <div class="row ">

                @foreach ($last_donations as $item)
                <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                    <a href="{{ route('donations.show', $item->slug) }}">
                        <div class="card rounded rounded-5 overflow-hidden shadow card-item">
                            @if ($item->thumbnail && $item->thumbnail->file_path)
                            <img src="{{ $item->thumbnail->file_path }}" class="card-img-top img-fluid blog-img"
                                alt="..." style="object-fit: cover !important; height: 180px !important; width: 500px !important">
                            @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                style="height: 160px;">
                                <span>No cover image</span>
                            </div>
                            @endif
                            <div class="card-body px-4">
                                <p class="card-text text-dark">
                                    {{ Str::limit(strip_tags($item->title), 30, '...') }}
                                </p>
                                <p class="card-description text-muted" style="font-size:0.8rem ; width:90%; text-align: justify;">
                                    {{ Str::limit(strip_tags($item->description), 80, '...') }}
                                </p>
                                <p class="text-dark mb-2">
                                    <i class="fa fa-user"></i>
                                    {{ $item->towards ?? 'Anonim' }}
                                </p>
                                <p class="text-primary text-small mb-1">
                                    Target
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar progress-bar-animated" role="progressbar"
                                        style="width: {{ (str_replace(['Rp', '.', ','], '', $item->total_donated) / intval(str_replace(['Rp', '.', ','], '', $item->target_amount))) * 100 }}%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                </p>
                                <p class="text-medium mt-2">
                                    Rp {{ number_format($item->total_donated, 0, ',', '.') }}/ <span
                                        class="fw-bold">Rp
                                        {{ number_format($item->target_amount, 0, ',', '.') }}</span>
                                    <br>
                                <p class="text-small">{{ $item->donator_count }} donatur</p>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>

    </div>

</section>
<!-- End Donate Content Section -->

<!-- Quote Content Section -->
<section id="quote-content" class="space-section">
    <div class="container-fluid d-flex justify-content-center align-items-center text-center bg-skyline"
        style="background-image: url('{{ $content['quote_section']['image'] }}'); height: 400px; background-size: cover; background-position: center; background-repeat: no-repeat;">
        <p class="text-light m-0" style="font-size: 35px; text-shadow: 2px 2px #000;">
            {{ $content['quote_section']['quote'] }}<br>
            <span class="fw-bold mt-3">- {{ $content['quote_section']['author'] }} -</span>
        </p>
    </div>
</section>

<!-- End Quote Content Section -->

<!-- Blog Upcoming Event -->
<section id="upcoming-content" class="space-section container-fluid bg-skyline w-100">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-6 d-flex justify-content-start">
                <h1 class="bolder-text text-dark text-start">@lang('messages.upcoming_event')</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('events') }}" class="btn rounded rounded-5 fw-light" id="button-event"
                    style="border: 2px solid #1a3a4f; color: #1a3a4f;padding: 10px 20px;">
                    @lang('messages.see_more')
                </a>
            </div>
        </div>
    </div>



    <div class="container mx-auto bg-skyline pt-4 " id="container-upcoming"
        style="padding: 0 !important;">
        <div class="row justify-content-start text-center py-0 my-0 gx-4" style="margin: 0 !important;">

            @foreach ($last_events as $item)
            <div class="col-md-6 col-lg-4 col-12 d-flex justify-content-center mt-4 ">
                <a href="{{ route('events.show', $item->slug) }}" class="text-light"
                    href="{{ url('/detail_event') }}">
                    <div class="event-card rounded rounded-5">
                        @if ($item->thumbnail && $item->thumbnail->file_path)
                        <img src="{{ $item->thumbnail->file_path }}" alt="{{ $item->title }}"
                            class="img-fluid overflow-hidden" style="height: 450px !important;">
                        @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                            style="height: 450px;">
                            <span>No cover image</span>
                        </div>
                        @endif
                        <div class="">
                            <div class="event-date">{{ $item->detailEvent->start->format('d M Y') }}</div>
                        </div>

                        <div class="event-details event-card-spacer">
                            <p class="event-title mb-3 fw-bold">
                                {{ Str::limit(strip_tags($item->title), 55, '...') }}
                            </p>
                            <div class="event-info d-flex card-desc mb-3 justify-content-between">
                                <span><i class="fa fa-clock"></i> {{ $item->detailEvent->start->format('H:i') }} -
                                    {{ $item->detailEvent->end->format('H:i') }}</span>
                                <span><i class="fa fa-location-dot"></i>
                                    {{ $item->location->name_location }}</span>
                            </div>
                            <p class="card-text  text-extra-small  card-desc  small">
                                {{ Str::limit(strip_tags($item->description), 100, '...') }}
                            </p>
                            <p class="card-text  text-extra-small  card-desc small mt-3">
                                <a href="" class="me-2 text-light"><i class="fas fa-grip-horizontal"></i>
                                    {{ $item->category->name }} </a>
                                <a href="" class="text-light"><i class="fa fa-user"></i>
                                    {{ $item->user->name ?? 'Anonim' }}</a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End Blog Upcoming Event -->

<!-- Blog Invitatitation -->
<section id="blog-invitation" class="space-section">
    <div class="banner py-0 w-100">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 style="font-size: 60px;">@lang('messages.help_means')</h1>
            <p style="font-size: 41px;">@lang('messages.donate_now')</p>
            <a href="{{ url('/donations') }}" class="btn btn-custom btn-primary" id="button-event"
                style="font-size: 24px;">@lang('messages.btn_donate')</a>
            <a href="{{ url('/events') }}">
                <button class="btn btn-primary btn-custom" id="button-event"
                    style="font-size: 24px;">@lang('messages.btn_volunteer')</button>
            </a>
        </div>
    </div>
</section>
<!-- End Blog Invitatitation -->

<!-- Blog Content Section -->
<section id="blog-content" class="space-section">
    <div class="container">
        <h1 class="bolder-text text-dark text-center ">Blog & Article</h1>
        <div class="pb-5 mb-5" id="card-donate">
            <div class="row justify-content-center align-items-center">
                <div class="row mx-2">
                    <h3 class="fw-bold">Blog & Article</h3>
                    <div class="d-flex flex-wrap align-items-center pb-2">
                        <!-- Paragraf -->
                        <p class="text-muted mb-2 flex-grow-1 col-12 col-lg-10">
                            @lang('messages.blog_intro')
                        </p>
                        <!-- Tombol -->
                        <a href="{{ route('blog') }}" class="btn rounded rounded-5  fw-light col-4 col-lg-2"
                            style="border: 2px solid #1a3a4f; color: #1a3a4f; padding: 5px 10px;">
                            @lang('messages.see_more')
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($last_articles as $item)
                    <div class="d-flex justify-content-center col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card rounded rounded-5 overflow-hidden shadow w-100 d-flex flex-column">
                            @if ($item->thumbnail && $item->thumbnail->file_path)
                            <div class="position-relative">
                                <a href="{{ route('blog.show', $item->slug) }}">
                                    <img src="{{ $item->thumbnail->file_path }}"
                                        class="card-img-top img-fluid blog-img" alt="{{ $item->title }}"
                                        style="height: 200px !important; object-fit: cover !important;">
                                </a>
                                <div class="blog-date">
                                    {{ $item->created_at->locale('id')->diffForHumans() ? $item->created_at->locale('id')->diffForHumans() : 'Tanggal tidak tersedia' }}
                                </div>
                            </div>
                            @else
                            <a href="{{ route('blog.show', $item->slug) }}">
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                    style="height: 200px;">
                                    <span>No cover image</span>
                                </div>
                            </a>
                            @endif
                            <div
                                class="card-body blog-details-container d-flex flex-column justify-content-between px-4">
                                <b class="text-dark">
                                    {{ Str::limit(strip_tags($item->title), 35, '...') }}
                                </b>
                                <p class="card-text text-primary text-small mt-3">
                                    {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                </p>
                                <div class="text-primary text-small mb-3">
                                    <a href="" class="me-2"><i
                                            class="fas fa-grip-horizontal text-dark"></i>
                                        {{ $item->category->name }} </a>
                                    <a href=""><i class="fa fa-user text-dark"></i>
                                        {{ $item->user->name ?? 'Anonim' }}</a>
                                </div>
                                <div class="d-flex w-100">
                                    <a href="{{ route('blog.show', $item->slug) }}" class="btn blog-btn w-100">
                                        @lang('messages.btn_read_more')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Blog Content Section -->

<!-- FAQ Content Section -->
<section id="accodrion" class="space-section">
    <h1 class="bolder-text text-dark text-center mb-5 ">@lang('messages.faq_title')</h1>
    <div class="container">
        <div class="row d-flex align-items-stretch">
            <!-- Kolom Kiri: Gambar -->
            <div class="col-lg-6 col-12 text-center justify-content-center mb-5">
                <img src="{{ url('/images/faq.svg') }}" alt="" class="img img-fluid">
            </div>
            <!-- Kolom Kanan: Accordion -->
            <div class="col-lg-6 col-12 p-4">
                <div class="accordion" id="accordionExample">
                    @foreach ($content['faq_section']['faq'] as $index => $faq)
                    <div class="accordion-item accordion-rounded mb-3">
                        <h2 class="accordion-header accordion-rounded" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $index }}">
                                <B>{{ $faq['questions'] }}</B>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $faq['answers'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content Section -->
@endsection