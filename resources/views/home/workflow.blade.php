@extends('layout.main')

@push('header')
@endpush

@section('main')
    <!--==============================
                    Breadcumb
                    ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/banner/banner-workflow.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Workflow</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Workflow</li>
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
                    <h3 class="">Fishing</h3>
                    <p>Our fishing process begins in the rich pelagic waters of Indonesia, where local fishermen sustainably
                        catch mackerel, sardine, scad, and other high-demand export species. Using regulated methods such as
                        net hauling and longline operations, we ensure every catch meets international traceability and
                        sustainability requirements. Freshly harvested fish are immediately handled onboard to preserve
                        temperature and quality, forming the first step of our export-grade supply chain. This commitment to
                        responsible fishing supports long-term seafood availability and strengthens our position as a
                        trusted Indonesian seafood exporter for global markets.
                    </p>
                    <div class=" position-relative mb-30">
                        <div class="mega-hover">
                            <img src="{{ asset('home/img/fishing.jpg') }}" alt="service image" class="w-100">
                        </div>
                    </div>
                    <h3 class="">Processing</h3>
                    <p>Once landed, all seafood enters our HACCP-certified processing facilities, where it undergoes
                        rigorous sorting, grading, filleting, and rapid freezing using blast-freezer and –20°C cold-chain
                        systems. Our trained processing team ensures every product—from whole round pelagic fish to fillet
                        and block forms—meets the strict specifications demanded by international buyers. With consistent
                        grading, hygienic workflow, and export-standard handling, we maintain product quality that aligns
                        with global import regulations. This precision-driven processing makes our Indonesian seafood highly
                        competitive in international markets.
                    </p>
                    <div class=" position-relative mb-30">
                        <div class="mega-hover">
                            <img src="{{ asset('home/img/processing.jpg') }}" alt="service image" class="w-100">
                        </div>
                    </div>
                    <h3 class="">Packing</h3>
                    <p>After processing, products are vacuum-packed or placed in food-grade PE liners before being boxed,
                        palletized, and securely wrapped for container loading. Each pallet is prepared for –22°C reefer
                        container shipment to preserve freshness throughout international transit. Our packing standards
                        follow export requirements for stability, hygiene, and traceability, ensuring seamless customs
                        clearance for overseas buyers. With efficient packaging and cold-chain logistics, we deliver
                        Indonesian pelagic seafood to global destinations with consistent quality and strong export
                        reliability.
                    </p>
                    <div class=" position-relative mb-30">
                        <div class="mega-hover">
                            <img src="{{ asset('home/img/packing.jpg') }}" alt="service image" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
@endpush
