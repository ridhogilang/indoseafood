@extends('layout.main')

@push('header')
    <style>
        section ul {
            margin-left: 30px;
            /* jarak dari tepi container */
            padding-left: 20px;
            /* jarak bullet dari margin */
            list-style-type: disc;
            /* bullet standar, bisa diganti circle atau square */
        }

        section ul li {
            margin-bottom: 8px;
            /* jarak antar item list */
        }

        /* opsional: buat h4 sedikit menonjol */
        section h4 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: 600;
        }
    </style>
@endpush

@section('main')
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/banner/banner-term.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Terms and Conditions</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Terms and Conditions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Terms and Conditions</h3>
                    <p>These Terms and Conditions (“Terms”) govern your use of the IndoSeafood website and the purchase,
                        sale, and export of seafood products. By accessing our website or placing an order, you agree to
                        these Terms. Please read them carefully before engaging in any business transaction.</p>

                    <h4>1. General</h4>
                    <p>IndoSeafood reserves the right to modify these Terms at any time. Updated Terms will be posted on our
                        website, and continued use constitutes acceptance.</p>

                    <h4>2. Orders and Acceptance</h4>
                    <ul>
                        <li>All orders are subject to acceptance by IndoSeafood. We may refuse or cancel orders at our
                            discretion.</li>
                        <li>Confirmation of an order constitutes a binding agreement between the buyer and IndoSeafood.</li>
                        <li>Product descriptions, pricing, and availability are accurate at the time of publication but may
                            change without notice.</li>
                    </ul>

                    <h4>3. Pricing and Payment</h4>
                    <ul>
                        <li>Prices are quoted in the specified currency and do not include taxes, customs duties, or
                            shipping fees unless explicitly stated.</li>
                        <li>Payment terms will be stated in the invoice or contract. Full or partial advance payment may be
                            required for export orders.</li>
                        <li>IndoSeafood reserves the right to suspend shipments for overdue payments.</li>
                    </ul>

                    <h4>4. Shipping and Delivery</h4>
                    <ul>
                        <li>Products are shipped using cold-chain logistics in compliance with international standards.</li>
                        <li>Delivery dates are estimates and not guaranteed. IndoSeafood is not responsible for delays
                            caused by carriers, customs, or force majeure events.</li>
                        <li>Risk of loss or damage transfers to the buyer upon loading into the shipping container.</li>
                    </ul>

                    <h4>5. Product Quality and Inspection</h4>
                    <ul>
                        <li>All seafood products meet our export-grade quality standards and comply with relevant
                            international regulations.</li>
                        <li>Buyers are encouraged to inspect products upon receipt and report any discrepancies within a
                            specified timeframe.</li>
                        <li>IndoSeafood liability for defective products is limited to replacement or refund at our
                            discretion, unless otherwise agreed in writing.</li>
                    </ul>

                    <h4>6. Cancellation and Returns</h4>
                    <ul>
                        <li>Order cancellations must be requested in writing and are subject to approval.</li>
                        <li>Returned products must comply with hygiene and safety regulations and will only be accepted if
                            defective or damaged due to our error.</li>
                    </ul>

                    <h4>7. Limitation of Liability</h4>
                    <p>IndoSeafood shall not be liable for any indirect, incidental, or consequential damages arising from
                        the use of our website or the purchase of products. Our total liability is limited to the purchase
                        price of the affected products.</p>

                    <h4>8. Intellectual Property</h4>
                    <p>All content, images, logos, and materials on the IndoSeafood website are protected by copyright and
                        may not be reproduced without written permission.</p>

                    <h4>9. Governing Law</h4>
                    <p>These Terms are governed by the laws of the Republic of Indonesia. Any disputes arising from these
                        Terms or transactions with IndoSeafood will be subject to the jurisdiction of Indonesian courts,
                        unless otherwise agreed.</p>

                    <h4>10. Force Majeure</h4>
                    <p>IndoSeafood shall not be liable for any failure or delay in performance caused by events beyond our
                        reasonable control, including natural disasters, war, labor disputes, or government regulations
                        affecting international shipping.</p>

                    <h4>11. Contact</h4>
                    <p>If you have any questions regarding these Terms and Conditions, please contact us at:</p>
                    <p class="mb-5">
                        <strong>IndoSeafood</strong><br>
                        Email: <a href="mailto:privacy@indoseafood.com">privacy@indoseafoods.com</a><br>
                        Address: Penjaringan, Jakarta Utara, DKI Jakarta, Indonesia 14440<br>
                        Phone: +62 857-7187-6270
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
@endpush
