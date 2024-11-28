@extends('front.layout.app')

@section('style')
    <style>
        :root {
            --light-color: #FFFFFF;
            --dark-color: #145071;
            --skyline-color: #E9F4FA;
            --aqua-color: #6CB6DE;
            --primary-color: #2185BB;

            --font-size-extra-small: 10px;
            --font-size-small: 13px;
            --font-size-medium: 16px;
            --font-size-large: 20px;
        }

        .blog-details-container {
            padding: 20px 30px;
        }

        .content-spacer {
            margin-bottom: 50px;
        }

        .social-links {
            margin: 0;
            padding: 0;
            margin-top: 10px;
            list-style-type: none;
            display: inline-block;
        }

        .social-links li {
            display: inline-block;
            margin-right: 50px;
        }

        .social-links li:last-child {
            margin-right: 0;
        }

        .social-links a {
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            background-color: var(--dark-color);
            font-size: 22px;
            color: var(--light-color);
            text-align: center;
            border-radius: 5px;
        }

        .social-links a:hover {
            color: var(--dark-color);
            background-color: var(--aqua-color);
        }

        .custom-textarea {
            height: 200px;
        }

        .custom-textarea::placeholder {
            color: var(--primary-color);
            opacity: 1;
        }

        .search-container {
            padding: 0px;
        }

        /* Search bar styling */
        .search-box {
            display: flex;
            align-items: center;
            border-radius: 20px;
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
            border-radius: 20px 0 0 20px;
            flex: 1;
            font-size: 16px;
        }

        /* Tombol pencarian */
        .search-box .search-btn {
            background-color: #4ca3dd;
            /* Warna biru */
            color: #fff;
            border: none;
            border-radius: 0 20px 20px 0;
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

        .media-img {
            overflow: hidden;
            border-radius: 5px;
        }

        .media-img img {
            width: 100%;
            height: 100%;
            -webkit-transition: 0.4s ease-in-out;
            transition: 0.4s ease-in-out;
        }

        .post-title {
            font-weight: 600;
            font-size: 18px;
            line-height: 26px;
            margin: 0 0 8px 0;
            text-transform: capitalize;
        }

        .recent-post-meta p {
            text-transform: capitalize;
            font-size: 14px;
        }

        .post-title .recent-post-meta p:hover {
            color: #4b9bf0 !important;
        }

        .recent-post:hover .media-img img {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }

        .th-comments-wrap {
            padding: 40px;
            /* box-shadow: 0px 6px 30px rgba(7, 36, 95, 0.07); */
        }

        .th-comments-wrap {
            --border-color: #E2E8FA;
            margin-bottom: 30px;
        }

        .th-comments-wrap .description p:last-child {
            margin-bottom: -0.5em;
        }

        .th-comments-wrap .comment-respond {
            margin: 30px 0;
        }

        .th-comments-wrap pre {
            background: #ededed;
            color: #666;
            font-size: 14px;
            margin: 20px 0;
            overflow: auto;
            padding: 20px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .th-comments-wrap li {
            margin: 0;
        }

        .th-comments-wrap .th-post-comment {
            padding: 0;
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 30px;
            padding-bottom: 30px;
            position: relative;
            border-bottom: 1px solid var(--th-border-color);
        }

        .th-comments-wrap .th-post-comment ol,
        .th-comments-wrap .th-post-comment ul,
        .th-comments-wrap .th-post-comment dl {
            margin-bottom: 1rem;
        }

        .th-comments-wrap .th-post-comment ol ol,
        .th-comments-wrap .th-post-comment ol ul,
        .th-comments-wrap .th-post-comment ul ol,
        .th-comments-wrap .th-post-comment ul ul {
            margin-bottom: 0;
        }

        .th-comments-wrap ul.comment-list {
            list-style: none;
            margin: 0;
            padding: 0;
            margin-bottom: -30px;
        }

        .th-comments-wrap ul.comment-list ul ul,
        .th-comments-wrap ul.comment-list ul ol,
        .th-comments-wrap ul.comment-list ol ul,
        .th-comments-wrap ul.comment-list ol ol {
            margin-bottom: 0;
        }

        .th-comments-wrap .comment-avater {
            width: 60px;
            height: 60px;
            margin-right: 20px;
            overflow: hidden;
            border-radius: 5px;
        }

        .th-comments-wrap .comment-avater img {
            width: 100%;
        }

        .th-comments-wrap .comment-content {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            margin-top: -6px;
            position: relative;
        }

        .th-comments-wrap .commented-on {
            font-size: 14px;
            display: inline-block;
            margin-bottom: 2px;
            font-weight: 400;
            color: var(--body-color);
        }

        .th-comments-wrap .commented-on i {
            margin-right: 7px;
            font-size: 0.9rem;
        }

        .th-comments-wrap .name {
            font-size: 20px;
        }

        .th-comments-wrap .comment-top {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .th-comments-wrap .text {
            margin-bottom: 10px;
        }

        .th-comments-wrap .children {
            margin: 0;
            padding: 0;
            list-style-type: none;
            margin-left: 80px;
        }

        .th-comments-wrap .reply_and_edit {
            margin-top: 12px;
            margin-bottom: -0.46em;
        }

        .th-comments-wrap .reply_and_edit a {
            margin-right: 10px;
        }

        .th-comments-wrap .reply_and_edit a:last-child {
            margin-right: 0;
        }

        .th-comments-wrap .reply-btn {
            font-weight: 600;
            font-size: 16px;
            color: var(--theme-color);
            display: inline-block;
        }

        .th-comments-wrap .reply-btn i {
            margin-right: 7px;
        }

        .th-comments-wrap .reply-btn:hover {
            color: var(--title-color);
        }

        .th-comments-wrap .star-rating {
            font-size: 12px;
            margin-bottom: 10px;
            position: absolute;
            top: 5px;
            right: 0;
            width: 80px;
        }

        ul.comment-list .th-comment-item:last-child>.th-post-comment {
            border-bottom: none;
            padding-bottom: 0;
        }

        ul.comment-list .th-comment-item:first-child>.th-post-comment {
            padding-bottom: 30px;
            border-bottom: 1px solid var(--th-border-color);
        }

        .th-comments-wrap.th-comment-form {
            margin: 0;
        }

        /* Medium Large devices */
        @media (max-width: 1399px) {
            .blog-content {
                padding: 40px 20px;
            }

            .blog-title {
                font-size: 28px;
            }

            .share-links {
                --blog-space-x: 20px;
            }

            .th-comments-wrap .children {
                margin-left: 40px;
            }

            .th-comment-form,
            .th-comments-wrap {
                padding: 40px 20px;
            }
        }

        /* Medium devices */
        @media (max-width: 991px) {
            .blog-content {
                padding: 40px;
            }

            .blog-details .blog-single {
                --blog-space-x: 20px;
                --blog-space-y: 40px;
            }

            .share-links {
                --blog-space-x: 40px;
            }

            .th-comment-form,
            .th-comments-wrap {
                padding: 40px;
            }
        }

        @media (max-width: 767px) {
            .share-links {
                --blog-space-x: 20px;
            }

            .blog-details .blog-single {
                --blog-space-x: 20px;
                --blog-space-y: 20px;
            }

            .blog-single .blog-content {
                padding: 30px 20px;
            }

            .blog-single .blog-title {
                font-size: 24px;
                line-height: 1.3;
            }

            .blog-single .blog-text {
                margin-bottom: 22px;
            }

            .blog-single .blog-bottom {
                padding-top: 15px;
            }

            .blog-single .share-links-title {
                font-size: 18px;
                display: block;
                margin: 0 0 10px 0;
            }

            .social-links li {
                display: inline-block;
                margin-right: 20px;
            }

            .th-comment-form {
                --blog-space-x: 20px;
            }

            .th-comment-form,
            .th-comments-wrap {
                padding: 40px 20px;
            }

            .th-comments-wrap .th-post-comment {
                display: block;
            }

            .th-comments-wrap .star-rating {
                position: relative;
                top: 0;
                right: 0;
            }

            .th-comments-wrap .comment-top {
                display: block;
            }

            .th-comments-wrap .comment-avater {
                margin-right: 0;
                margin-bottom: 25px;
            }

            .th-comments-wrap .children {
                margin-left: 40px;
            }

            .th-comments-wrap .children {
                margin-left: 30px;
            }

            .th-comments-wrap .reply_and_edit a {
                margin-right: 5px;
            }

            .custom-margin {
                padding-right: 0;
            }
        }

        @media (max-width: 330px) {
            .post-title {
                font-size: 14px;
                line-height: 24px;
            }

            .recent-post-meta p {
                font-size: 12px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section2 w-100 space-section" style="background-image: url('/images/hero-bg-2.svg');">
        <div class="hero-overlay2"></div>
        <div class="hero-content2 text-left px-5 ms-5">
            <h1 class="hero-title2">Detail Artikel</h1>
            <p class="hero-subtitle2">Blog > <span>Peduli Sesama: Aksi Donasi untuk Korban Bencana Alam</span></p>
        </div>
    </section>
    <!-- End Hero Section -->

    <section class="th-blog-wrapper blog-details space-section">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        <div class="mb-3">
                            @if ($article->thumbnail && $article->thumbnail->file_path)
                                <img class="img img-fluid rounded rounded-3"
                                    src="{{ asset('storage/cover/' . $article->thumbnail->file_path) }}"
                                    alt="{{ $article->title }}">
                            @else
                                <span>No cover image available</span>
                            @endif
                            <p class="text-primary text-medium mt-3">
                                {{ $article->created_at->format('d F Y') }} |
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>
                        <div class="card rounded rounded-3 px-3 py-1 my-5">
                            <div class="blog-content text-dark fs-6">
                                <h2 class="bolder-text content-spacer">{{ $article->title }}</h2>
                                <p class="text-justify">
                                    {!! $article->content !!}
                                </p>
                                <p class="text-justify content-spacer">
                                    Artikel ini telah dilihat sebanyak <b>{{ $article->views }}</b> kali.
                                </p>
                            </div>

                            <div class="share-links text-center text-dark content-spacer">
                                <b class="fs-4 mb-2">Bagikan Artikel Ini</b><br>
                                <ul class="social-links">
                                    <li><a href="https://www.instagram.com/?url={{ url()->current() }}" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://api.whatsapp.com/send?text={{ url()->current() }}"
                                            target="_blank"><i class="fab fa-whatsapp"></i></a>
                                    </li>
                                    <li><a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank"><i
                                                class="fab fa-twitter"></i></a>
                                    </li>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                </ul><!-- End Social Share -->
                            </div>


                            <div class="th-comment-form text-dark fs-4" id="disqus_thread">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                @include('front.layout.side_widgetBlog')
            </div>
        </div>
    </section>


    <!-- Blog Invitatitation -->
    <section id="blog-invitation" class="space-section">
        <div class="banner py-0 w-100">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <h1 style="font-size: 60px;">Your help means a lot</h1>
                <p style="font-size: 41px;">donate or be a volunteer now!</p>
                <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Donate</button>
                <button class="btn btn-custom" id="button-event" style="font-size: 40px;">Sukarelawan</button>
            </div>
        </div>
    </section>
    <!-- End Blog Invitatitation -->
@endsection

@section('script')
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://donasikita.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
@endsection
