<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootsrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    {{-- FontAwesome 6 CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    {{-- Poppins Font CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    {{-- Swiperjs CSS Link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @yield('style')
</head>

<body class="bg-skyline">
    @include('front.layout.header')
    @yield('content')
    @include('front.layout.footer')
    <a href="https://wa.me/yourphonenumber" target="_blank" class="whatsapp-icon">
        <i class="fab fa-whatsapp"></i>
    </a>
    <script src="/js/bootsrap.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/js/swiper.js"></script>
    @yield('script')
</body>

</html>