@extends('layout.main')

@push('header')
@endpush

@section('main')
    <!--==============================
                        Breadcumb
                        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="assets/img/breadcrumb/breadcrumb-1-1.png">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                        Contact Form Area
                        ==============================-->
    <section class="space">
        <div class="container mb-40">
            <p>Get in touch with our export team for inquiries about Indonesian pelagic fish, frozen seafood products,
                container-load supply, or customized specifications. Whether you are an importer, distributor, wholesaler, or
                food-service buyer, we are ready to assist you with pricing, availability, documentation, and shipment options.
                Our team responds quickly to international requests and ensures smooth communication throughout your seafood
                sourcing and export process.</p><br><br>
            <div class="info-box">
                <div class="row g-xl-5">
                    <div class="col-lg-4">
                        <div class="vs-media align-items-center">
                            <div class="media-icon"><i class="fas fa-map-marked-alt"></i></div>
                            <div class="media-body">
                                <h3 class="info-box-title">Address</h3>
                                <p class="media-info">RT.20/RW.17, Penjaringan, Kecamatan
                                    Penjaringan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14440</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="vs-media align-items-center">
                            <div class="media-icon"><i class="fas fa-address-card"></i></div>
                            <div class="media-body">
                                <h3 class="info-box-title">Contact</h3>
                                <p class="media-info">
                                    Email:
                                    <a class="text-inherit" href="mailto:info@indoseafood.com">
                                        info@indoseafood.com
                                    </a>
                                </p>

                                <p class="media-info">
                                    Phone:
                                    <a class="text-inherit" href="tel:+62857718762706">
                                        +62 857-7187-62706
                                    </a>
                                </p>

                                <p class="media-info">
                                    WhatsApp:
                                    <a class="text-inherit" href="https://wa.me/6285771876270" target="_blank">
                                        +62 857-7187-6270
                                    </a>
                                </p>

                                <p class="media-info">
                                    WeChat:
                                    <a class="text-inherit" href="weixin://dl/chat?userid=6285771876270">
                                        +62 857-7187-6270
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="vs-media align-items-center">
                            <div class="media-icon"><i class="fas fa-clock"></i></div>
                            <div class="media-body"><br>
                                <h3 class="info-box-title">Office Hour</h3>
                                <p class="media-info">Monday - Friday: <a class="text-inherit" href="">8:30 -
                                        20:00</a>
                                </p>
                                <p class="media-info mb-4">Saturday & Sunday: <a class="text-inherit" href="">9:30 -
                                        21:30</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================
                        Map Area
                        ==============================-->
    <div class="container-fluid p-0">
        <div class="ratio ratio-21x9" style="height:620px">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d147528.2835205243!2d106.78772030202165!3d-6.142472339569099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMDYnMjguMCJTIDEwNsKwNDgnMTkuNSJF!5e1!3m2!1sid!2sid!4v1763915585835!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection

@push('footer')
@endpush
