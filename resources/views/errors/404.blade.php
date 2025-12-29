<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Error Page</title>
    <meta name="author" content="IndoSeafood">
    <meta http-equiv="content-language" content="en">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Indonesia">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" href="{{ asset('home/img/logo icon.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Inter&display=swap"
        rel="stylesheet">
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
    <section class="space">
        <div class="container">
            <div class="row  text-center justify-content-center">
                <div class="col-xl-12 mb-5">
                    <div class="error-img">
                        <img src="{{ asset('home/img/eror-1-1.svg') }}" alt="error image">
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="error-content text-center">
                        <div class="title-area text-center mb-0 wow fadeInUp wow-animated" data-wow-delay="0.3s">
                            <span class="sec-subtitle">Error Page</span>
                            <h3 class="sec-title">Oops! That Page Can't Be Found.</h3>
                        </div>
                        <p class="error-text">Unfortunately, something went wrong and this page does not exist. Try
                            using the search or return to the previous page.</p>
                        <a href="{{ route('home') }}" class="vs-btn">Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('home/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/js/slick.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('home/js/wow.min.js') }}"></script>
    <script src="{{ asset('home/js/main.js') }}"></script>
</body>

</html>
