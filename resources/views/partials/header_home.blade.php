<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <button class="vs-menu-toggle"><i class="fa fa-times"></i></button>
        <div class="mobile-logo">
            <a href="index.html"><img src="{{ asset('home/img/logo.png') }}" alt="Marino"></a>
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('produk') }}">Products</a>
                </li>
                <li>
                    <a href="{{ route('about') }}">About Us</a>
                </li>
                <li>
                    <a href="{{ route('workflow') }}">Workflow</a>
                </li>
                <li>
                    <a href="{{ route('quote') }}">Get a Quote</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
     Preloader
    ==============================-->
<div class="preloader">
    <button class="vs-btn preloaderCls">Cancel Preloader </button>
    <div class="preloader-inner text-center">
        <img src="{{ asset('home/img/logo.png') }}" alt="Marino">
        <span class="loader"></span>
    </div>
</div>
<!--==============================
    Header Area
    ==============================-->
<header class="vs-header">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-xl-between justify-content-md-center align-items-center gx-50">
                <div class="col d-none d-xl-block">
                    <div class="header-links">
                        <ul>
                            <li>
                                <a href="https://maps.app.goo.gl/NdFttp1hJRpByHxNA" target="_blank"><i
                                        class="fa fa-map-marker-alt"></i>Penjaringan, Jakarta Utara, DKI Jakarta
                                    14440</a>
                            </li>
                            <li>
                                <a href="mailto:info@indoseafood.com"><i class="fa fa-envelope"></i>
                                    info@indoseafood.com </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-auto d-flex align-items-center text-center">
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-globe"></i> English
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Bangla</a></li>
                        </ul>
                    </div>
                    <div class="social-media">
                        <a href="#"><i class="fa fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vs-container1">
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="vs-logo">
                                <a href="index.html"><img src="{{ asset('home/img/logo.png') }}" alt="logo"></a>
                                <a href="index.html" class="sticky-logo"><img src="{{ asset('home/img/logo.png') }}"
                                        alt="logo"></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-50 align-items-center ">
                                <div class="col">
                                    <nav class="main-menu d-none d-lg-block">
                                        <ul>
                                            <li>
                                                <a href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('produk') }}">Products</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('about') }}">About Us</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('workflow') }}">Workflow</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('quote') }}">Get a Quote</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('contact') }}">Contact Us</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-auto d-lg-none">
                                    <button class="vs-menu-toggle d-inline-block">
                                        <i class="fa-solid fa-bars"></i> </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="header-info">
                                        <div class="icon-btn"
                                            style="width:45px; height:45px; display:flex; justify-content:center; align-items:center;">
                                            <i class="fa-brands fa-whatsapp" style="font-size:24px;"></i>
                                        </div>

                                        <div class="media-body">
                                            <span class="header-info_label">Call Now</span>
                                            <div class="header-info_link">
                                                <a href="https://wa.me/6285771876270">(+62) 857-7187-6270</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
