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
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-cover-wrapper">
        <div class="auth-cover-content-inner">
            <div class="auth-cover-content-wrapper">
                <div class="auth-img">
                    <img src="{{ asset('') }}admin/images/auth/auth-cover-login-bg.svg" alt=""
                        class="img-fluid">
                </div>
            </div>
        </div>
        <div class="auth-cover-sidebar-inner">
            <div class="auth-cover-card-wrapper">
                <div class="auth-cover-card p-sm-5">
                    <div class="wd-50 mb-5">
                        <img src="{{ asset('home/img/logo icon.png') }}" alt="" class="img-fluid">
                    </div>
                    <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                    <h4 class="fs-13 fw-bold mb-2">Sign In to Continue</h4>
                    <p class="fs-12 fw-medium text-muted">
                        We're glad to see you again at <strong>IndoSeafood</strong>. Please log in to proceed.
                        Need access? Contact our admin and we’ll help you get started.
                    </p>
                    <form action="{{ route('login.perform') }}" method="POST" class="w-100 mt-4 pt-2">
                        @csrf

                        {{-- Notifikasi sukses (misal reset password) --}}
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        {{-- Error pesan --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" value="1" class="custom-control-input"
                                        id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label c-pointer" for="rememberMe">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div>
                                <a href="" class="fs-11 text-primary">
                                    Forget password?
                                </a>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-lg btn-primary w-100">
                                Login
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>   
    <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin/js/common-init.min.js') }}"></script>
    <script src="{{ asset('admin/js/theme-customizer-init.min.js') }}"></script>
</body>

</html>
