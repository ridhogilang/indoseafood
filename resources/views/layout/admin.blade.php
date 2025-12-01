<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Duralux || Dashboard</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}admin/images/favicon.ico" />
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/bootstrap.min.css" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    @stack('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/theme.min.css" />
</head>

<body>
    @include('partials.header_admin')

    <main class="nxl-container">
        @yield('main')
        @include('partials.footer_admin')
    </main>

    @yield('modal')

    <script src="{{ asset('') }}admin/vendors/js/vendors.min.js"></script>

    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    @stack('footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = @json(session('success'));
            const errorMessage = @json(session('error'));

            @if ($errors->any())
                const firstError = @json($errors->first());
            @else
                const firstError = null;
            @endif

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                    confirmButtonText: 'OK'
                });
            }

            if (errorMessage || firstError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage || firstError,
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>

</body>

</html>
