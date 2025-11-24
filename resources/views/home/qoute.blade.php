@extends('layout.main')

@push('header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

    <!-- utils.js untuk format & validasi -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"></script>

    <style>
        /* FIX Notyf success */
        .notyf__toast--success {
            background: #4caf50 !important;
            color: #fff !important;
        }

        /* FIX Notyf error */
        .notyf__toast--error {
            background: #e53935 !important;
            color: #fff !important;
        }

        /* Text inside toast */
        .notyf__message {
            color: #fff !important;
        }

        /* Biar wrapper intl-tel-input tetap full width mengikuti col-12 / col-md-6 */
        .iti {
            width: 100% !important;
            display: block !important;
        }

        .iti input {
            width: 100% !important;
            border-radius: 8px;
            /* biru yang sama dengan form lainnya */
            padding: 10px 12px 10px 12px;
            font-size: 14px;
            line-height: 1.4;
            background-color: #fff;
            color: #2c3e50;
            /* ganti sesuai warna teks umummu */
        }

        /* Lebarkan area bendera + kode negara */
        .iti--separate-dial-code .iti__flag-container {
            width: 120px;
            /* silakan adjust 80–100px */
            background-color: #f5f7fb;
            /* biar nyatu sama form-mu */
        }

      

        /* Biar ujung kiri & kanan kelihatan satu kotak halus */
        .iti--separate-dial-code .iti__flag-container,
        .iti--separate-dial-code .iti__tel-input {
            border-radius: 19px;
        }

        /* Hilangkan double radius di tengah (supaya kelihatan satu kotak) */
        .iti--separate-dial-code .iti__flag-container {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .iti--separate-dial-code .iti__tel-input {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Jarak bawah supaya tidak nempel dengan field berikutnya */
        .wa-group {
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('main')
    <!--==============================
                                                                                                Breadcumb
                                                                                                ==============================-->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/banner/banner-quote.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Get a Qoute</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Get a Qoute</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                                                                                                Check Out Area
                                                                                                ==============================-->
    <div class="vs-checkout-wrapper space">
        <div class="container">
            <p class="mb-60">Request export pricing for Indonesian pelagic fish, frozen seafood products, and processed
                items directly
                from our HACCP-certified facilities. Fill out the form below to receive a customized quotation based on your
                required species, grading, volume, packaging style, and destination port. Our team will respond with
                detailed export pricing, shipping options, and product availability tailored for international buyers and
                importers.</p>
            <form action="{{ route('quote.store') }}" method="POST" class="form-area mt-20">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-12 form-group">
                                <input type="text" name="company_name"
                                    class="form-control @error('company_name') is-invalid @enderror"
                                    placeholder="Your Company Name" value="{{ old('company_name') }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PHONE (optional) --}}
                            <div class="col-md-6 form-group">
                                <input type="text" id="phone" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- WHATSAPP (required) --}}
                            <div class="col-md-12 form-group wa-group mb-4">
                                <input type="tel" id="wa_input"
                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                    placeholder="Whatsapp number" autocomplete="off">

                                <input type="hidden" name="whatsapp" id="whatsapp_full" value="{{ old('whatsapp') }}">

                                @error('whatsapp')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- PORT OF DESTINATION (required) --}}
                            <div class="col-12 form-group">
                                <input type="text" name="port_of_destination"
                                    class="form-control @error('port_of_destination') is-invalid @enderror"
                                    placeholder="Port of Destination (e.g. Xiamen Port, China)"
                                    value="{{ old('port_of_destination') }}" required>
                                @error('port_of_destination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">

                            {{-- FISH NAME (required) --}}
                            <div class="col-12 form-group">
                                <input type="text" name="fish_name"
                                    class="form-control @error('fish_name') is-invalid @enderror"
                                    placeholder="Fish Name (e.g. Yellowfin Tuna)" value="{{ old('fish_name') }}" required>
                                @error('fish_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- LATIN NAME (optional) --}}
                            <div class="col-12 form-group">
                                <input type="text" name="latin_name"
                                    class="form-control @error('latin_name') is-invalid @enderror"
                                    placeholder="Latin Name (e.g. Thunnus albacares)" value="{{ old('latin_name') }}">
                                @error('latin_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- FREEZING METHOD (optional) --}}
                            <div class="col-md-6 form-group">
                                <input type="text" name="freezing_method"
                                    class="form-control @error('freezing_method') is-invalid @enderror"
                                    placeholder="Freezing Method (e.g. IQF, -22°C)" value="{{ old('freezing_method') }}">
                                @error('freezing_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SIZE (required) --}}
                            <div class="col-md-6 form-group">
                                <input type="text" name="size"
                                    class="form-control @error('size') is-invalid @enderror"
                                    placeholder="Size (e.g. 1–3 kg)" value="{{ old('size') }}" required>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- QUANTITY (required) --}}
                            <div class="col-md-6 form-group">
                                <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                    placeholder="Quantity (Kg)" value="{{ old('qty') }}" required>
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NOTE (optional) --}}
                            <div class="col-12 form-group">
                                <textarea name="note" cols="20" rows="5" class="form-control @error('note') is-invalid @enderror"
                                    placeholder="Notes">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SUBMIT --}}
                            <div class="col-12 form-group text-end">
                                <button type="submit" class="vs-btn">
                                    Submit Inquiry
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var notyf = new Notyf({
                    duration: 3000,
                    position: {
                        x: 'right',
                        y: 'top',
                    }
                });

                notyf.success("{{ session('success') }}");
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top',
                    }
                });

                notyf.error("Please check the form again.");
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === PHONE FORMATTER ===
            const phoneInput = document.getElementById('phone');

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = phoneInput.value;

                    // pastikan selalu diawali '+'
                    if (!value.startsWith('+')) {
                        value = '+' + value.replace(/^\+*/, '');
                    }

                    // buang semua karakter kecuali + dan angka
                    value = value.replace(/[^\d+]/g, '');

                    // pisahkan prefix + dan angka
                    const digits = value.replace(/\D/g, ''); // hanya angka
                    if (digits.length === 0) {
                        phoneInput.value = '+';
                        return;
                    }

                    // misal: +6281234567890 -> +62-8123-4567-890
                    const countryCode = digits.substring(0, 3); // kamu bisa ubah logic ini
                    const rest = digits.substring(3);

                    let groups = [];
                    for (let i = 0; i < rest.length; i += 4) {
                        groups.push(rest.substring(i, i + 4));
                    }

                    const formatted = '+' + countryCode + (groups.length ? '-' + groups.join('-') : '');
                    phoneInput.value = formatted;
                });

                // kalau kosong, isi minimal '+'
                phoneInput.addEventListener('blur', function() {
                    if (phoneInput.value.trim() === '') {
                        phoneInput.value = '';
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waInput = document.querySelector("#wa_input");
            const waFull = document.querySelector("#whatsapp_full");

            if (!waInput || !waFull) return;

            // Init intl-tel-input
            const iti = window.intlTelInput(waInput, {
                initialCountry: "id",
                separateDialCode: true, // +62 muncul di kiri, BUKAN di input
                nationalMode: true, // user ketik nomor lokal saja
                autoPlaceholder: "off",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
            });

            // Kalau ada old('whatsapp') -> isi lagi
            if (waFull.value) {
                try {
                    // ini akan otomatis set country + isi input dengan NOMOR LOKAL
                    iti.setNumber(waFull.value);
                } catch (e) {
                    console.warn('Cant set WA number from old value', e);
                }
            }

            function formatLocalDigits(raw) {
                // hanya angka
                let digits = raw.replace(/\D/g, '');

                // hapus semua 0 di depan (tidak boleh mulai 0)
                digits = digits.replace(/^0+/, '');

                // bikin strip setiap 4 digit: 8123-4567-890
                return digits.replace(/(\d{3,4})(?=\d)/g, '$1-');
            }

            function updateWhatsappHidden() {
                // Ambil angka dari input (tanpa strip)
                let digits = waInput.value.replace(/\D/g, '');
                digits = digits.replace(/^0+/, ''); // buang 0 depan

                // Tampilkan ke user dengan strip2
                if (digits.length) {
                    waInput.value = formatLocalDigits(digits);
                } else {
                    waInput.value = '';
                }

                // Ambil kode negara dari plugin
                const data = iti.getSelectedCountryData(); // { dialCode: "62", ... }

                if (!data.dialCode || !digits) {
                    waFull.value = '';
                    return;
                }

                // Nilai yang dikirim ke server: +62 + 81234567890
                waFull.value = '+' + data.dialCode + digits;
            }

            waInput.addEventListener('input', updateWhatsappHidden);
            waInput.addEventListener('blur', updateWhatsappHidden);

            // Kalau user ganti negara di dropdown
            waInput.addEventListener('countrychange', updateWhatsappHidden);
        });
    </script>


@endpush
