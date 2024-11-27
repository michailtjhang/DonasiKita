@extends('front.layout.app')
@section('content')
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
            <div class="col-xxl-8 col-lg-7 ">
                <div class="th-blog blog-single">
                    <div class="mb-3">
                        <img class="img img-fluid rounded rounded-3" src="images/blog-details/thumbnail.svg" alt="Blog Image">
                        <p class="text-primary text-medium mt-3">
                            21 November 2024 | Donasi Kita
                        </p>
                    </div>
                    <div class="card rounded rounded-3 px-3 py-1 my-5">
                        <div class="blog-content text-dark fs-6">
                            <h2 class="bolder-text content-spacer">Peduli Sesama: Aksi Donasi untuk Korban Bencana Alam</h2>
                            <p class="text-justify">
                                Kehidupan tidak selalu berjalan mulus, dan ketika bencana melanda, peran kita sebagai manusia adalah saling membantu. Dalam aksi terbaru ini, kami menggalang bantuan untuk mereka yang terdampak bencana alam di wilayah Indonesia. Bersama-sama, kita dapat memberikan harapan baru bagi saudara-saudara kita yang tengah membutuhkan.
                            </p>
                            <blockquote class="px-5 text-center text-small content-spacer">
                                <i class="fa fa-quote-right fs-1 text-primary"></i>
                                <p>“Kemanusiaan adalah tentang bagaimana kita merespons penderitaan orang lain dengan cinta dan aksi nyata.”</p>
                            </blockquote>
                            <p class="text-justify">
                                Donasi yang Anda berikan akan digunakan untuk kebutuhan darurat seperti makanan, obat-obatan, tempat tinggal sementara, dan kebutuhan mendesak lainnya. Kami percaya bahwa setiap rupiah yang Anda sumbangkan dapat mengubah hidup seseorang.
                            </p>

                            <p>
                                <b>Apa yang Bisa Anda Lakukan?</b>
                            <ol>
                                <li>Ikut berdonasi melalui platform kami.</li>
                                <li>Sebarkan informasi ini kepada orang-orang di sekitar Anda.</li>
                                <li>Jadilah sukarelawan dalam kegiatan penggalangan dana kami.</li>
                            </ol>
                            </p>
                            <p class="text-justify content-spacer">
                                Mari bergandengan tangan untuk membangun kembali harapan mereka yang terkena dampak bencana. Semua donasi akan dikelola secara transparan dan kami akan memberikan laporan lengkap setelah kampanye selesai.
                            </p>
                            <div class="row content-spacer">
                                <div class="col-md-6 sm-margin">
                                    <img class="img img-fluid rounded rounded-3" src="images/blog-details/1.svg" alt="Blog Image">
                                </div>
                                <div class="col-md-6">
                                    <img class="img img-fluid rounded rounded-3" src="images/blog-details/2.svg" alt="Blog Image">
                                </div>
                            </div>
                        </div>
                        <div class="share-links text-center text-dark content-spacer">
                            <b class="fs-4 mb-2">Share This Article</b><br>
                            <ul class="social-links">
                                <li><a href="https://www.instagram.com/donasi__kita/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            </ul><!-- End Social Share -->
                        </div>
                    </div>
                    <div class="card rounded rounded-3 px-3 py-3 md-margin-extra">
                        <div class="th-comment-form text-dark fs-4">
                            <div class="form-title">
                                <p class="blog-inner-title mb-2">Post Comment</p>
                                <hr class="w-100 bg-primary" style="height: 3px; border: none;">
                            </div>
                            <div class="row">
                                <div class="col-12 form-group mb-2">
                                    <textarea placeholder="Write Your Comments..." class="form-control text-primary custom-textarea"></textarea>
                                </div>
                                <div class="col-12 form-group mb-0 d-flex justify-content-end">
                                    <button class="btn bg-dark text-light">Post</button>
                                </div>
                            </div>
                        </div>
                        <div class="th-comments-wrap text-dark">
                            <ul class="comment-list">
                                <li class="th-comment-item">
                                    <hr class="w-100 bg-primary" style="height: 3px; border: none; margin-top: 5px;">
                                    <div class="th-post-comment">
                                        <div class="comment-avater">
                                            <img src="images\blog-details\avatar-1.svg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <h3 class="name">Sindy Pratiwi</h3>
                                            <span class="commented-on">Nov 22, 2024 at 15:00</span>
                                            <div class="card rounded rounded-3 px-3 py-3">
                                                <p class="text">Terima kasih sudah membuat program seperti ini. Sangat menginspirasi, saya akan ikut berdonasi.</p>
                                            </div>
                                            <div class="reply_and_edit">
                                                <div class="row">
                                                    <div class="col-12 form-group mb-2">
                                                        <div class="row">
                                                            <div class="col-md-2 col-3 custom-margin">
                                                                <a href="" class="text-dark">Reply</a>
                                                            </div>
                                                            <div class="col-md-10 col-9">
                                                                <input type="text" class="form-control" placeholder="Write Your Comments...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group mb-0 d-flex justify-content-end">
                                                        <button class="btn bg-dark text-light">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="th-comment-item">
                                    <hr class="w-100 bg-primary" style="height: 3px; border: none; margin-top: 5px;">
                                    <div class="th-post-comment">
                                        <div class="comment-avater">
                                            <img src="images\blog-details\avatar-2.svg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <h3 class="name">Alfred Davidson</h3>
                                            <span class="commented-on">Nov 22, 2024 at 18:00</span>
                                            <div class="card rounded rounded-3 px-3 py-3">
                                                <p class="text">Semoga kampanye ini sukses dan bisa membantu banyak orang. Sudah share ke grup keluarga</p>
                                            </div>
                                            <div class="reply_and_edit">
                                                <div class="row">
                                                    <div class="col-12 form-group mb-2">
                                                        <div class="row">
                                                            <div class="col-md-2 col-3 custom-margin">
                                                                <a href="" class="text-dark">Reply</a>
                                                            </div>
                                                            <div class="col-md-10 col-9">
                                                                <input type="text" class="form-control" placeholder="Write Your Comments...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group mb-0 d-flex justify-content-end">
                                                        <button class="btn bg-dark text-light">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- Comment end --> <!-- Comment Form -->
                    </div>


                </div>
            </div>
            <div class="col-xxl-4 col-lg-5 text-dark">
                <aside class="sidebar-area">
                    <div class="widget widget_search mb-2">
                        <form class="search-form">
                            <div class="search-container align-items-center">
                                <div class="search-box">
                                    <input type="text" class="form-control" placeholder="Cari Artikel">
                                    <button class="btn search-btn" type="button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="widget content-spacer">
                        <div class="row justify-content-between">
                            <div class="col-sm-auto align-self-end fs-4">
                                <p class="text-dark bolder-text">Related Posts</p>
                            </div>
                            <div class="col-sm-auto mt-2 fs-6 ">
                                <a style="text-decoration:#2185BB!important;" href="">See More</a>
                            </div>
                        </div>
                        <div class="recent-post-wrap">
                            <!-- Post 1 -->
                            <div class="recent-post card mb-2 shadow rounded rounded-4">
                                <div class="row d-flex align-items-center">
                                    <div class="media-img col-4">
                                        <a href="">
                                            <img class="img img-fluid rounded rounded-4" src="images/blog-details/post-1.svg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body col-8 px-4 justify-content-center">
                                        <h4 class="post-title">
                                            <a class="text-dark fs-5" href="">
                                                Bantuan untuk Korban Banjir di Jawa Barat
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <p class="text-primary"> 10 Nov 24 | Bencana | Rina M</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 2 -->
                            <div class="recent-post card mb-2 shadow rounded rounded-4">
                                <div class="row d-flex align-items-center">
                                    <div class="media-img col-4">
                                        <a href="">
                                            <img class="img img-fluid rounded rounded-4" src="images/blog-details/post-2.svg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body col-8 px-4 justify-content-center">
                                        <h4 class="post-title">
                                            <a class="text-dark fs-5" href="">
                                                Donasi untuk Gempa Lombok
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <p class="text-primary"> 05 Nov 24 | Bencana | Andi. P</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 3 -->
                            <div class="recent-post card mb-2 shadow rounded rounded-4">
                                <div class="row d-flex align-items-center">
                                    <div class="media-img col-4">
                                        <a href="">
                                            <img class="img img-fluid rounded rounded-4" src="images/blog-details/post-3.svg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body col-8 px-4 justify-content-center">
                                        <h4 class="post-title">
                                            <a class="text-dark fs-5" href="">
                                                Edukasi untuk Anak-Anak Terdampak
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <p class="text-primary"> 02 Nov 24 | Edukasi | Siti A</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card rounded rounded-3 shadow justify-content-center px-3 py-3 widget">
                        <p class="text-dark fs-4" style="margin-bottom: 2px;">Tags</p>
                        <hr class="w-100" style="height: 2px; border: none; background-color: #145071; opacity: 1; margin-top: 5px;">
                        <div class="tagcloud">
                            <ul style="list-style: none; padding-left: 0;">
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#DonasiBencana</a>
                                </li>
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#PeduliSesama</a>
                                </li>
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#AksiKemanusiaan</a>
                                </li>
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#BantuanGempa</a>
                                </li>
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#HarapanBaru</a>
                                </li>
                                <li class="mb-3">
                                    <a class="bg-dark text-light btn">#IndonesiaPeduli</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
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