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
                        <h2 class="fs-20 fw-bolder mb-4">Resetting</h2>
                        <h4 class="fs-13 fw-bold mb-2">Reset to your password</h4>
                        <p class="fs-12 fw-medium text-muted">Enter your email and a reset link will sent to you, let's
                            access our the best recommendation for you.</p>
                        <form action="{{ route('password.update') }}" method="POST" class="w-100 mt-4 pt-2">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-4">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="New Password">
                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1">
                                        <i class="feather-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Conform Password">
                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1">
                                        <i class="feather-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin/js/common-init.min.js') }}"></script>
    <script src="{{ asset('admin/js/theme-customizer-init.min.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.show-pass1');
            if (!toggle) return;

            const input = toggle.closest('.input-group').querySelector('input');
            const icon = toggle.querySelector('i');

            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';

                // ganti icon → eye-off
                icon.classList.remove('feather-eye');
                icon.classList.add('feather-eye-off');
            } else {
                input.type = 'password';

                // ganti icon → eye
                icon.classList.remove('feather-eye-off');
                icon.classList.add('feather-eye');
            }
        });
    </script>
</body>

</html>
