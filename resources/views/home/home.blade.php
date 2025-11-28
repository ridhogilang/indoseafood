@extends('layout.main')

@push('header')
    <style>
        .service-icon {
            display: flex;
            justify-content: center;
            /* horizontal center */
            align-items: center;
        }

        .service-icon i {
            font-size: 200% !important;
            transition: 0.3s;
        }

        .service-style1:hover .service-icon i {
            color: #ffffff !important;
            /* ganti warna saat hover */
        }

        /* CSS kamu (tetap) */
        .certificate-row {
            gap: 30px !important;
            justify-content: center;
            padding: 0 40px;
        }

        .certificate-item {
            width: 180px;
            height: 270px;
            padding: 10px;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .certificate-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* ✅ Override khusus HP */
        @media (max-width: 767.98px) {
            .certificate-row {
                padding: 0 16px;
                /* biar nggak terlalu jauh dari pinggir */
            }

            .certificate-row .col-auto {
                width: 100%;
                /* tiap slide isi 1 kolom penuh */
                display: flex;
                justify-content: center;
                /* center-in isi slide */
            }

            .certificate-item {
                width: 100%;
                max-width: 320px;
                /* muat di layar HP, tapi tetap proporsional */
                height: auto;
                aspect-ratio: 210 / 297;
                /* tetap rasa A4 */
                margin: 0 auto;
                /* pastikan benar2 di tengah */
            }
        }

        .hero-layout1 .slick-arrow {
            display: none !important;
        }

        .service-area .slick-arrow {
            display: none !important;
        }

        /* Default (desktop/laptop) */
        .explore-text {
            padding: 0 100px;
        }

        /* Tablet */
        @media (max-width: 991px) {
            .explore-text {
                padding: 0 80px;
            }
        }

        /* HP besar */
        @media (max-width: 767px) {
            .explore-text {
                padding: 0 30px;
            }
        }

        /* HP kecil */
        @media (max-width: 480px) {
            .explore-text {
                padding: 0 20px;
            }
        }
    </style>
@endpush

@section('main')
    <div class="hero-layout1 shape-mockup-wrap position-relative">
        <div class="row vs-carousel" data-arrows="fae" data-dots="true" data-dots-lg-show="true" data-fade="true">
            <div class="hero-inner">
                <div class="hero-bg background-image" data-bg-src="{{ asset('home/img/banner/banner1.jpg') }}">
                </div>
                <div class="shape-mockup hero-shape jump-img d-none d-xxl-block">
                    <img src="{{ asset('') }}home/img/bg/hero-shape1.png" alt="hero shape">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">Premium Indonesian Seafood Exporter</h1>
                        <p class="hero-text">Supplying high-quality tuna, mackerel, sardine, and Indonesian wild-caught
                            seafood to global markets with consistent volume and HACCP-certified processing.</p>
                        <div class="hero-btns">
                            <a href="about.html" class="vs-btn me-3">About Us <i class="fa fa-arrow-right"></i></a>
                            <a href="https://www.youtube.com/watch?v=EGW2HS2tqAQ" class="play-btn1 popup-video"><i
                                    class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-inner">
                <div class="hero-bg background-image" data-bg-src="{{ asset('home/img/banner/banner2.jpg') }}">
                </div>
                <div class="shape-mockup hero-shape jump-img d-none d-xxl-block">
                    <img src="{{ asset('') }}home/img/bg/hero-shape1.png" alt="hero shape">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">Frozen Seafood for Global Buyers</h1>
                        <p class="hero-text">From blast-frozen tuna loins to whole round sardines, we ensure top-grade
                            quality, reliable supply, and fast loading for international shipments.</p>
                        <div class="hero-btns">
                            <a href="course.html" class="vs-btn me-3">About Us <i class="fa fa-arrow-right"></i></a>
                            <a href="https://www.youtube.com/watch?v=EGW2HS2tqAQ" class="play-btn1 popup-video"><i
                                    class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-inner">
                <div class="hero-bg background-image" data-bg-src="{{ asset('home/img/banner/banner3.jpg') }}">
                </div>
                <div class="shape-mockup hero-shape jump-img d-none d-xxl-block">
                    <img src="{{ asset('') }}home/img/bg/hero-shape1.png" alt="hero shape">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">Trusted Indonesian Seafood Exporter</h1>
                        <p class="hero-text">We deliver certified, sustainable, and well-handled seafood products directly
                            from Indonesian waters to importers, distributors, and wholesalers worldwide.</p>
                        <div class="hero-btns">
                            <a href="course.html" class="vs-btn me-3">About Us <i class="fa fa-arrow-right"></i></a>
                            <a href="https://www.youtube.com/watch?v=EGW2HS2tqAQ" class="play-btn1 popup-video"><i
                                    class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                     Service Area
                 ==============================-->
    <section class="space service-area">
        <div class="container">
            <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                {{-- <span class="sec-subtitle">our Service</span> --}}
                <h2 class="sec-title">Why Choose Indonesian Seafood?</h2>
                <div class="sec-line"></div>
            </div>
            <div class="row vs-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2"
                data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true" data-lg-center-mode="true"
                data-md-center-mode="true" data-sm-center-mode="true" data-xs-center-mode="true" data-arrows="true"
                data-dots="fae">
                <div class="col-auto">
                    <div class="service-style1">
                        <div class="service-img"><img src="{{ asset('home/img/why/why1.jpg') }}" alt="service thumbnail">
                        </div>
                        <div class="service-icon"><i class="fa-solid fa-fish-fins" style="color: #74C0FC;"></i></div>
                        <h3 class="service-title h6"><a class="text-inherit" href="service-details.html">Ocean Freshness</a>
                        </h3>
                        <p class="service-text">Wild-caught from Indonesian waters, delivering naturally fresher and firmer
                            seafood.</p>
                        {{-- <div class="link-btn">
                            <a href="service-details.html">Read More <i class="fa fa-arrow-right"></i></a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="service-style1">
                        <div class="service-img"><img src="{{ asset('home/img/why/why2.jpg') }}" alt="service thumbnail">
                        </div>
                        <div class="service-icon"><i class="fa-solid fa-shield-halved" style="color: #74C0FC;"></i></div>
                        <h3 class="service-title h6"><a class="text-inherit" href="service-details.html">Certified
                                Processing</a></h3>
                        <p class="service-text">Handled in HACCP-certified facilities following strict international
                            food-safety standards.</p>
                        {{-- <div class="link-btn">
                            <a href="service-details.html">Read More <i class="fa fa-arrow-right"></i></a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="service-style1">
                        <div class="service-img"><img src="{{ asset('home/img/why/why3.jpg') }}" alt="service thumbnail">
                        </div>
                        <div class="service-icon"><i class="fa-solid fa-snowflake" style="color: #74C0FC;"></i>
                        </div>
                        <h3 class="service-title h6"><a class="text-inherit" href="service-details.html">Cold Chain</a>
                        </h3>
                        <p class="service-text">Maintained through blast freezing and –20°C storage to preserve peak
                            quality.</p>
                        {{-- <div class="link-btn">
                            <a href="service-details.html">Read More <i class="fa fa-arrow-right"></i></a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="service-style1">
                        <div class="service-img"><img src="{{ asset('home/img/why/why4.jpg') }}" alt="service thumbnail">
                        </div>
                        <div class="service-icon"><i class="fa-solid fa-repeat" style="color: #74C0FC;"></i>
                        </div>
                        <h3 class="service-title h6"><a class="text-inherit" href="service-details.html">Stable
                                Supply</a></h3>
                        <p class="service-text">Reliable large-scale volumes suitable for importers, distributors, and
                            container shipments.</p>
                        {{-- <div class="link-btn">
                            <a href="service-details.html">Read More <i class="fa fa-arrow-right"></i></a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="service-style1">
                        <div class="service-img"><img src="{{ asset('home/img/why/why5.jpg') }}"
                                alt="service thumbnail"></div>
                        <div class="service-icon"><i class="fa-solid fa-hand-holding-dollar" style="color: #74C0FC;"></i>
                        </div>
                        <h3 class="service-title h6"><a class="text-inherit" href="service-details.html">Competitive
                                Pricing</a></h3>
                        <p class="service-text">Efficient sourcing and processing ensure consistent, globally competitive
                            export prices.</p>
                        {{-- <div class="link-btn">
                            <a href="service-details.html">Read More <i class="fa fa-arrow-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================
                                                                                                     Shop Area
                                                                                                     ==============================-->
    <section class="bg-title space">
        <div class="container">
            <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                {{-- <span class="sec-subtitle">Shop</span> --}}
                <h2 class="sec-title text-white">Featured Products</h2>
                <div class="sec-line"></div>
            </div>
            <div class="row vs-carousel mb-4" data-arrows="true" data-wow-delay="0.4s" data-lg-slide-show="3"
                data-slide-show="4" data-md-slide-show="2" data-center-mode="true" data-xl-center-mode="true"
                data-ml-center-mode="true" data-lg-center-mode="true" data-md-center-mode="true"
                data-sm-center-mode="true">
                @foreach ($produk as $item)
                    <div class="col-auto">
                        <div class="product-style1">

                            {{-- PRODUCT IMAGE --}}
                            <div class="product-img">
                                <div class="clipped">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}">
                                </div>
                            </div>

                            {{-- PRODUCT BODY --}}
                            <div class="product-body">
                                <h3 class="product-title">
                                    {{ $item->name }}
                                </h3>

                                <p class="text-muted" style="font-size: 14px;">
                                    <i>{{ $item->latin_name }}</i>
                                </p>

                                {{-- PROCESSING LIST --}}
                                <p class="mb-0" style="font-size: 14px;">
                                    <strong>Processing:</strong><br>
                                    {{ $item->processings->pluck('name')->join(', ') }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div><br><br>
            <div class="hero-btns" style="display:flex; justify-content:center; align-items:center;">
                <a href="{{ route('produk') }}" class="vs-btn me-1">
                    All Products
                </a>
            </div>
        </div>
        </div>
    </section>
    <!--==============================
                                                                                                     Sertificate Area
                                                                                                     ==============================-->
    <section class="space sertificate">
        <div class="container">
            <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                <h2 class="sec-title">Our Business Certifications</h2>
                <div class="sec-line"></div>
                <p class="explore-text">
                    “Our seafood export operations are supported by complete and internationally recognized certifications,
                    ensuring full compliance with global import requirements. We provide all mandatory export documents such
                    as Health Certificates, Catch Certificates, Certificates of Origin, laboratory test reports, and other
                    official documents required for international seafood trade. These certifications demonstrate our
                    commitment to product safety, traceability, and regulatory standards, allowing importers, wholesalers,
                    and distributors to confidently source Indonesian pelagic fish and frozen seafood from us.
                </p>

            </div>
            <br><br>

            <!-- Tambah class js-mfp-gallery -->
            <div class="row certificate-row js-mfp-gallery vs-carousel" data-wow-delay="0.4s" data-lg-slide-show="5"
                data-slide-show="5" data-md-slide-show="5" data-center-mode="true" data-xl-center-mode="true"
                data-ml-center-mode="true" data-lg-center-mode="true" data-md-center-mode="true"
                data-sm-center-mode="true">
                @foreach (['HC.png', 'COO.png', 'Catch Certificate.png', 'Health Certificate.png', 'HACCP.png'] as $img)
                    <div class="col-auto">
                        <div class="certificate-item">
                            <!-- TETAP pakai popup-image, nggak usah ganti -->
                            <a href="{{ asset('home/sertifikat/' . $img) }}" class="popup-image">
                                <img src="{{ asset('home/sertifikat/' . $img) }}" alt="Certificate">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--==============================
                                                                                                     Team Galeri
                                                                                                     ==============================-->
    <section class="space bg-smoke">
        <div class="container">
            <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                <h2 class="sec-title">Our Gallery</h2>
                <div class="sec-line"></div>
            </div>
            <div class="row js-mfp-gallery vs-carousel" data-arrows="true" data-wow-delay="0.4s" data-slide-show="5"
                data-lg-slide-show="5" data-md-slide-show="2" data-center-mode="true" data-xl-center-mode="true"
                data-ml-center-mode="true" data-lg-center-mode="true" data-md-center-mode="true"
                data-sm-center-mode="true">
                @for ($i = 20; $i >= 1; $i--)
                    <div class="col-lg-4">
                        <div class="team-style1">
                            <div class="team-img">
                                <a href="{{ asset('home/galeri/file ' . $i . '.jpg') }}" class="popup-image">
                                    <img src="{{ asset('home/galeri/file ' . $i . '.jpg') }}"
                                        alt="galeri {{ $i }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <!--==============================
                                                                                                     BLog Area
                                                                                                     ==============================-->
    <section class="space blog">
        <div class="container">
            <div class="title-area text-center wow fadeInUp wow-animated" data-wow-delay="0.3s">
                <span class="sec-subtitle">Our Blog</span>
                <h2 class="sec-title">Our Latest News & Update</h2>
                <div class="sec-line"></div>
            </div>
            <div class="row vs-carousel" data-arrows="true" data-wow-delay="0.4s" data-slide-show="3"
                data-lg-slide-show="2" data-md-slide-show="2" data-center-mode="true" data-xl-center-mode="true"
                data-ml-center-mode="true" data-lg-center-mode="true" data-md-center-mode="true"
                data-sm-center-mode="true">
                @foreach ($articles as $article)
                    <div class="col-lg-4 col-md-6">

                        <div class="vs-blog blog-style1">
                            <div class="blog-img">

                                <img class="w-100" src="{{ Storage::url($article->thumbnail) }}"
                                    alt="{{ $article->title }}">

                                <div class="blog-meta2">
                                    <span class="day">{{ $article->created_at->format('d') }}</span>
                                    <span class="month">{{ $article->created_at->format('F') }}</span>
                                </div>
                            </div>

                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a><i class="fa fa-user"></i>Admin</a>
                                    <a><i class="fa fa-folder"></i>{{ $article->category->name ?? 'Uncategorized' }}</a>
                                </div>

                                <h4 class="blog-title">
                                    <a href="{{ route('article_show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h4>

                                <a href="{{ route('article_show', $article->slug) }}" class="link-btn">
                                    Read More <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div><br><br>
            <div class="hero-btns" style="display:flex; justify-content:center; align-items:center;">
                <a href="{{ route('article') }}" class="vs-btn me-1">
                    All Article
                </a>
            </div>
        </div>
    </section>
@endsection

@push('footer')
@endpush
