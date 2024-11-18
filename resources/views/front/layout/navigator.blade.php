<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootsrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

</head>

<body class="bg-skyline">
    @include('front.layout.header')
    @yield('content')
    @include('front.layout.footer')
    <a href="https://wa.me/yourphonenumber" target="_blank" class="whatsapp-icon">
        <i class="fab fa-whatsapp"></i>
    </a>
    <script src="/js/bootsrap.min.js"></script>
</body>

</html>