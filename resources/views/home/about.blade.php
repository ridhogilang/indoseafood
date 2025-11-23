@extends('layout.main')

@push('header')
@endpush

@section('main')
    <!--==============================
        Breadcumb
        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/about/banner-about.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">About Us</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
     Service Details Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="">Who We Are</h3>
                    <p>Ikan Indonesia is a trusted seafood export company specializing in wild-caught Indonesian seafood
                        sourced directly from the rich tropical waters of the archipelago. We focus on high-demand pelagic
                        species—such as mackerel, sardine, and scad—along with reef fish, cephalopods, and other ocean
                        products required by global buyers.
                    </p>
                    <p class="mb-30">Through strong partnerships with fishing communities across Indonesia, we maintain
                        reliable access
                        to fresh raw materials, enabling us to support long-term and container-scale supply for importers,
                        distributors, wholesalers, and food-service companies around the world.
                        Our foundation is built on integrity, food safety, and consistency—values that define how we operate
                        every day.
                    </p>
                    <div class="service-img position-relative mb-30">
                        <div class="mega-hover">
                            <img src="{{ asset('home/img/about/about1.png') }}" alt="service image" class="w-100">
                        </div>
                    </div>
                    <h4 class="h4">Our Commitment</h4>
                    <p>We are committed to delivering seafood that meets the highest international standards. Every product
                        goes through strict quality control, from harvesting, sorting, and cleaning to grading, freezing,
                        and packaging.
                        Our processing takes place in HACCP-certified facilities, ensuring compliance with global
                        food-safety regulations. With blast freezing technology and cold storage maintained at –20°C, we
                        preserve the natural texture, taste, and freshness of our seafood throughout the entire export
                        chain.
                        We aim to provide buyers with not only high-quality products but also transparent communication,
                        efficient handling, and dependable delivery schedules.
                    </p>
                    <h3 class="">What We Provide</h3>
                    <p>Ikan Indonesia offers a complete selection of Indonesian seafood products available in various
                        specifications including WR, GG, HGT, fillet, loin, and block forms. Our product range is ideal for
                        international markets that require flexibility, consistent grading, and multiple processing styles.
                        With a strong supply network, we support full-container loads, mixed-container shipments, and
                        regular monthly purchasing programs for clients who demand stable and scalable volume.
                        Whether the requirement is for retail, wholesale, industrial processing, or food-service
                        distribution, our products are curated to meet global standards.
                    </p>
                    <div class="row g-xl-5 mb-20 gy-3">
                        <div class="col-md-4">
                            <div class="mega-hover">
                                <img src="{{ asset('home/img/about/about4.png') }}" alt="service image" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mega-hover">
                                <img src="{{ asset('home/img/about/about3.png') }}" alt="service image" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mega-hover">
                                <img src="{{ asset('home/img/about/about2.png') }}" alt="service image" class="w-100">
                            </div>
                        </div>
                    </div>
                    <h3 class="">Our Export Standards</h3>
                    <p> We follow strict export documentation protocols to ensure smooth customs clearance in any
                        destination country. Our complete documentation set includes: </p>
                    <ul style="margin-left: 0; padding-left: 18px;">
                        <li><strong>Health Certificate</strong></li>
                        <li><strong>Catch Certificate</strong></li>
                        <li><strong>Certificate of Origin</strong></li>
                        <li><strong>Invoice & Packing List</strong></li>
                        <li><strong>Export Declaration (PEB)</strong></li>
                        <li><strong>Other country-specific requirements</strong></li>
                    </ul>
                    <p> With a complete and compliant documentation process, we help buyers minimize delays, reduce risks,
                        and secure safe, legal, and traceable shipments. </p>
                    <h3 class="">Who We Serve</h3>
                    <p>We export to clients across Asia, the Middle East, and Europe, supporting businesses that require
                        consistent quality and dependable supply. Our customers include seafood importers, distributors,
                        processors, supermarkets, and HoReCa suppliers who rely on stable volume and uncompromised
                        freshness.
                    </p>
                    <p class="mb-30">Our vision is to become a long-term strategic partner—offering competitive pricing,
                        scalable supply,
                        and professional communication tailored to the needs of international seafood buyers.
                    </p>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
@endpush
