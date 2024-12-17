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

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('style')
    <style>
        .swipper-box {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-slide {
            width: 1120px;
            max-width: 100%;
        }

        .slider-wrapper {
            margin: 0 30px 20px;
            padding: 20px 30px;
            overflow: hidden;
        }

        .content-img,
        .content-box {
            padding: 30px 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .content-img {
            position: relative;
            row-gap: px;
        }

        .overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 25px 25px 0px 0;
        }

        .overlay::before {
            content: '';
            position: absolute;
            height: 40px;
            width: 40px;
            left: 0;
            bottom: -40px;
        }

        .overlay::after {
            content: '';
            position: absolute;
            height: 40px;
            width: 40px;
            left: 0;
            bottom: -40px;
            border-radius: 25px 0 0 0;
        }

        .content-box .username {
            font-size: 26px;
            font-weight: 600;
            padding-bottom: 6px;
            z-index: 1;
        }

        .content-box .user-profession {
            font-size: 16px;
            font-weight: 500;
        }

        .social-icon {
            padding: 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            gap: 15px;
        }

        .social-icon li {
            list-style: none;
        }

        .social-icon li a {
            font-size: 20px;
            text-decoration: none;
            color: #fff;
            height: 32px;
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .slider-wrapper .swiper-pagination-bullet {
            height: 13px;
            width: 13px;
            opacity: 0.5;
        }

        .slider-wrapper .swiper-pagination-bullet-active {
            opacity: 1;
        }

        .slider-wrapper .swiper-slide-button {
            color: var(--dark-color);
            margin-top: -40px;
            transition: 0.5s;
        }

        .slider-wrapper .swiper-slide-button:hover {
            color: var(--aqua-color);
        }

        /* .img-about {
            border-radius: 10% !important;
        } */

        /* Responsive Code */
        @media screen and (max-width: 768px) {
            .slider-wrapper {
                margin: 0 20px 20px;
                padding: 20px 30px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section2 w-100 space-section align-items-center"
        style="background-image: url('/images/about-hero.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">{{ $content['hero_section']['title'] }}</h1>
            <p class="hero-subtitle2">{{ $content['hero_section']['subtitle'] }}</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Company Section -->
    <section id="about-company" class="space-section">
        <div class="container-fluid py-5 justify-content-center text-left bg-skyline">
            <div class="row mx-auto text-wrap" style="width:80%;">
                <div class="col-lg-6 col-12">
                    <img src="/images/about/logo.svg" class="about-image img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-12 text-dark align-items-center px-5">
                    <h3 class="bolder-text text-dark mb-3">{{ $content['company_section']['name'] }}</h3>
                    <p class="text-large-responsive">
                        {!! $content['company_section']['description'] !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Company Section -->

    <!-- Company Leader Section -->
    <section id="company-leader"
        class="space-section container align-items-center justify-content-center text-center w-100 vw-100">
        <h1 class="bolder-text text-dark text-center mb-4">Pendiri Lembaga</h1>
        <img src="{{ $content['founder_section']['image'] }}" class="img leader-image rounded rounded-5 img-about"
            alt="">
        <p class="fw-bold text-dark text-center text-large mt-4">{{ $content['founder_section']['name'] }}</p>
        <p class="text-dark text-center text-large">{{ $content['founder_section']['position'] }}</p>
    </section>
    <!-- End Company Leader Section -->

    <section id="company-team"
        class="space-section container align-items-center justify-content-center text-center w-100 vw-100">
        <h1 class="bolder-text text-dark text-center">Team</h1>
        <div class="swipper-box">
            <div class="container-slide swiper">
                <div class="slider-wrapper">
                    <div class="card-box swiper-wrapper">

                        @foreach ($content['team_section'] as $team)
                            <div class="swiper-slide">
                                <div class="content-img">
                                    <img src="{{ $team['image'] }}" class="img img-fluid" alt="{{ $team['name'] }}" />
                                </div>
                                <div class="content-box">
                                    <h5 class="text-dark fw-bold">{{ $team['name'] }}</h5>
                                    <p class="text-dark">{{ $team['position'] }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-slide-button swiper-button-prev"></div>
                    <div class="swiper-slide-button swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

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
@endsection
