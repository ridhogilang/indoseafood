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
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="display:flex; align-items:center; gap:8px;">

                            <!-- English Flag -->
                            <span style="width:20px; display:inline-block;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30">
                                    <clipPath id="t">
                                        <path d="M0,0 v30 h60 v-30 z" />
                                    </clipPath>
                                    <path d="M0,0 v30 h60 v-30 z" fill="#012169" />
                                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" />
                                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4" />
                                    <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                                    <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
                                </svg>
                            </span>
                            English
                        </button>

                        <ul class="dropdown-menu" style="margin:0;">
                            <li>
                                <a class="dropdown-item" href="#"
                                    style="display:flex; align-items:center; gap:8px;">
                                    <!-- EN -->
                                    <span style="width:20px; display:inline-block;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30">
                                            <path d="M0,0 v30 h60 v-30 z" fill="#012169" />
                                            <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" />
                                            <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4" />
                                            <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                                            <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
                                        </svg>
                                    </span>
                                    English
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"
                                    style="display:flex; align-items:center; gap:8px;">
                                    <!-- CN -->
                                    <span style="width:20px; display:inline-block;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20">
                                            <rect width="30" height="20" fill="#DE2910" />
                                            <polygon fill="#FFDE00" points="4,2 5,6 1,3 7,3 3,6" />
                                            <polygon fill="#FFDE00" points="10,2.5 11,3 10.2,3.2 10.5,4" />
                                            <polygon fill="#FFDE00" points="11,5 12,5.5 11.2,5.7 11.5,6.5" />
                                            <polygon fill="#FFDE00" points="11,8 12,8.5 11.2,8.7 11.5,9.5" />
                                            <polygon fill="#FFDE00" points="10,10 11,10.5 10.2,10.7 10.5,11.5" />
                                        </svg>
                                    </span>
                                    Chinese
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"
                                    style="display:flex; align-items:center; gap:8px;">
                                    <!-- ID -->
                                    <span style="width:20px; display:inline-block;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20">
                                            <rect width="30" height="10" fill="#CE1126" />
                                            <rect width="30" height="10" y="10" fill="#FFFFFF" />
                                        </svg>
                                    </span>
                                    Indonesian
                                </a>
                            </li>
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
