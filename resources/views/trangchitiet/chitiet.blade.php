<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('book_library/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('book_library/css/book_detail.css') }}">

    <script src="{{ asset('book_library/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>

<body class="tg-home tg-homeone">

    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!-- Header -->
        @include('trangchitiet.partials.header')

        <!-- Nội dung chính -->
        @include('trangchitiet.partials.sach_chitiet')

        <!-- Footer -->
        @include('trangchitiet.partials.footer')
    </div>

    <!-- JS -->
    <script src="{{ asset('book_library/js/vendor/jquery-library.js') }}"></script>
    <script src="{{ asset('book_library/js/vendor/bootstrap.min.js') }}"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
    <script src="{{ asset('book_library/js/owl.carousel.min.js') }}"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('book_library/js/jquery.vide.min.js') }}"></script>
    <script src="{{ asset('book_library/js/countdown.js') }}"></script>
    <script src="{{ asset('book_library/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('book_library/js/parallax.js') }}"></script>
    <script src="{{ asset('book_library/js/countTo.js') }}"></script>
    <script src="{{ asset('book_library/js/appear.js') }}"></script>
    <script src="{{ asset('book_library/js/gmap3.js') }}"></script>
    <script src="{{ asset('book_library/js/main.js') }}"></script>

</body>

</html>
