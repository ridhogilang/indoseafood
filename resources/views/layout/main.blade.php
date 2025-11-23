<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>IndoSeafood - {{ $title }}</title>
    <meta name="author" content="vecuro">
    <meta name="description" content="Marino HTML Template">
    <meta name="keywords" content="Marino HTML Template">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" href="{{ asset('home/img/logo icon.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Inter&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    @stack('header')

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('home/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('home/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
</head>

<body>
    @include('partials.header_home')
    @yield('main')
    @include('partials.footer_home')


    <a href="#" class="scrollToTop scroll-btn"><i class="fa fa-arrow-up"></i></a>
    <svg class="svg-shep1">
        <clipPath id="product-clip-path" clipPathUnits="objectBoundingBox">
            <path d="M0.289,0.963 C0.143,1,0.035,0.938,0,0.901 V0 H1 V0.963 C0.958,0.985,0.842,1,0.711,0.984 C0.547,0.938,0.473,0.915,0.289,0.963"></path>
        </clipPath>
    </svg>
    
    @stack('footer')
    <script src="{{ asset('home/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('home/js/slick.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Wow.js -->
    <script src="{{ asset('home/js/wow.min.js') }}"></script>
    <!-- Imagesloaded -->
    <script src="{{ asset('home/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('home/js/main.js') }}"></script>
    <script src="https://kit.fontawesome.com/d61a3422c6.js" crossorigin="anonymous"></script>
</body>

</html>