<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/img/logo icon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/theme.min.css') }}">
    <style>
        .resend-btn {
            font-size: 14px;
            /* ukuran sama seperti teks di sebelahnya */
            font-weight: 500;
            /* tidak bold berlebihan */
            color: #2f54eb;
            /* warna biru elegan */
            text-decoration: none;
            /* hilangkan garis bawah */
            padding: 0;
            margin: 0;
            background: none;
            /* hilangkan style tombol */
            border: none;
            cursor: pointer;
        }

        .resend-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .resend-btn:hover:not(:disabled) {
            text-decoration: underline;
            /* opsional: underline saat hover */
        }
    </style>
</head>

<body>

    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div
                        class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="{{ asset('home/img/logo icon.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Verify</h2>
                        <h4 class="fs-13 fw-bold mb-2">
                            Please enter the one-time password code to verify your account.
                        </h4>
                        <p class="fs-12 fw-medium text-muted">
                            <span>A code has been sent to </span>
                            <strong>{{ $maskedEmail }}</strong>
                        </p>


                        {{-- KIRIM OTP --}}
                        <form action="{{ route('otp.verify') }}" method="POST" class="w-100 mt-4 pt-2">
                            @csrf

                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                {{-- id tetap sama, hanya tambah name --}}
                                <input class="m-2 text-center form-control rounded" type="text" id="first"
                                    name="first" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded" type="text" id="second"
                                    name="second" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded" type="text" id="third"
                                    name="third" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded" type="text" id="fourth"
                                    name="fourth" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded" type="text" id="fifth"
                                    name="fifth" maxlength="1" required>
                                <input class="m-2 text-center form-control rounded" type="text" id="sixth"
                                    name="sixth" maxlength="1" required>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">
                                    Verify
                                </button>
                            </div>
                        </form>


                        <div class="mt-5 text-muted d-flex align-items-center gap-2">
                            <span>Didn't get the code?</span>

                            <form id="resendForm" action="{{ route('otp.resend') }}" method="POST"
                                style="display: inline;">
                                @csrf

                                <button type="submit" id="resendButton" class="resend-btn"
                                    @if ($remainingSeconds > 0) disabled @endif>
                                    Resend
                                </button>

                            </form>

                            <span id="resendTimer" class="fs-12"></span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin/js/common-init.min.js') }}"></script>
    <script src="{{ asset('admin/js/theme-customizer-init.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            function OTPInput() {
                const inputs = document.querySelectorAll("#otp > *[id]");
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener("keydown", function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = "";
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== "") {
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendButton = document.getElementById('resendButton');
            const resendTimer = document.getElementById('resendTimer');

            // pastikan integer
            let remaining = parseInt('{{ (int) $remainingSeconds }}', 10);
            if (isNaN(remaining) || remaining < 0) {
                remaining = 0;
            }

            // kalau sudah expired dari lama → langsung aktif, tanpa timer
            if (remaining <= 0) {
                if (resendButton) {
                    resendButton.disabled = false;
                }
                if (resendTimer) {
                    resendTimer.textContent = '';
                }
                return;
            }

            function updateTimer() {
                const minutes = String(Math.floor(remaining / 60)).padStart(2, '0');
                const seconds = String(remaining % 60).padStart(2, '0');
                resendTimer.textContent = `(${minutes}:${seconds})`;
            }

            updateTimer();

            const intervalId = setInterval(() => {
                remaining--;

                if (remaining <= 0) {
                    clearInterval(intervalId);

                    if (resendButton) {
                        resendButton.disabled = false; // ⬅️ baru bisa diklik di sini
                    }
                    if (resendTimer) {
                        resendTimer.textContent = '';
                    }

                    return;
                }

                updateTimer();
            }, 1000);
        });
    </script>
</body>

</html>
