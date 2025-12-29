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
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/banner/banner-privacy.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Privacy</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Privacy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Privacy Policy – IndoSeafood</h3>
                    <p>IndoSeafood we is committed to protecting your privacy and complying with
                        international data protection regulations. This Privacy Policy explains how we collect, use, store,
                        and share your personal data when you access our website, interact with our services, or engage in
                        business transactions, including seafood export operations.</p>

                    <h4>1. Information We Collect</h4>
                    <p>We collect personal and non-personal information for various purposes, including fulfilling export
                        orders, improving services, and ensuring legal compliance:</p>
                    <ul>
                        <li><strong>Personal Information:</strong> Name, email, phone, company, job title, and address.</li>
                        <li><strong>Transactional Information:</strong> Order details, quotations, invoices, shipping
                            documentation, and payment history.</li>
                        <li><strong>Technical Information:</strong> IP address, browser type, device information, cookies,
                            and website usage data.</li>
                        <li><strong>Regulatory Information:</strong> Identification and licensing data required for
                            international seafood export and customs compliance.</li>
                    </ul>

                    <h4>2. How We Use Your Information</h4>
                    <p>Your data is used for:</p>
                    <ul>
                        <li>Processing orders, quotations, and customer inquiries efficiently.</li>
                        <li>Ensuring compliance with international seafood export, customs, and trade regulations.</li>
                        <li>Improving our website, products, and services based on usage analytics.</li>
                        <li>Providing updates, newsletters, and marketing communications with your consent.</li>
                        <li>Maintaining security of transactions and preventing fraud.</li>
                    </ul>

                    <h4>3. Legal Basis for Processing</h4>
                    <p>We process personal data based on:</p>
                    <ul>
                        <li>Consent provided by you (e.g., newsletter subscription or inquiry forms).</li>
                        <li>Performance of a contract (e.g., order fulfillment or export agreements).</li>
                        <li>Legal obligations (e.g., customs, export documentation, tax regulations).</li>
                        <li>Legitimate business interests (e.g., fraud prevention, business analysis, and website
                            optimization).</li>
                    </ul>

                    <h4>4. Data Sharing and Third Parties</h4>
                    <p>We may share your information with:</p>
                    <ul>
                        <li>Trusted logistics and shipping partners for container and cold-chain delivery.</li>
                        <li>Payment processors and financial institutions for transactions.</li>
                        <li>Regulatory authorities for customs, import/export, and trade compliance.</li>
                        <li>Third-party service providers assisting in website operations, marketing, or analytics under
                            strict confidentiality agreements.</li>
                    </ul>

                    <h4>5. International Data Transfers</h4>
                    <p>Since IndoSeafood operates globally, your personal data may be transferred to and stored in countries
                        outside your residence. We ensure all international transfers comply with applicable data protection
                        laws, such as GDPR, and implement adequate safeguards.</p>

                    <h4>6. Data Retention</h4>
                    <p>We retain personal information only as long as necessary for:</p>
                    <ul>
                        <li>Fulfilling contractual obligations.</li>
                        <li>Legal, regulatory, or accounting requirements.</li>
                        <li>Resolving disputes and enforcing agreements.</li>
                    </ul>

                    <h4>7. Your Rights</h4>
                    <p>Depending on your jurisdiction, you may have the right to:</p>
                    <ul>
                        <li>Access, correct, or delete your personal data.</li>
                        <li>Withdraw consent for processing at any time.</li>
                        <li>Request restriction of processing or data portability.</li>
                        <li>Object to processing for marketing or legitimate business interests.</li>
                    </ul>
                    <p>To exercise your rights, please contact us at <a
                            href="mailto:privacy@indoseafood.com">privacy@indoseafood.com</a>.</p>

                    <h4>8. Data Security</h4>
                    <p>We implement technical and organizational measures to protect your data against unauthorized access,
                        loss, or misuse. This includes secure servers, encryption, restricted access, and employee training
                        in data protection, particularly for sensitive export and trade information.</p>

                    <h4>9. Cookies and Tracking</h4>
                    <p>Our website uses cookies and similar technologies to enhance user experience, analyze traffic, and
                        support marketing. You can manage cookie preferences through your browser settings.</p>

                    <h4>10. Minors</h4>
                    <p>IndoSeafood does not knowingly collect personal information from individuals under 18. If you believe
                        we have inadvertently collected data from a minor, please contact us for deletion.</p>

                    <h4>11. Changes to This Policy</h4>
                    <p>We may update this Privacy Policy periodically to reflect changes in legal requirements, business
                        operations, or technology. The latest version will always be posted on our website.</p>

                    <h4>12. Contact Us</h4>
                    <p>If you have questions or concerns about your privacy or this policy, please contact us:</p>
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
