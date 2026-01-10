<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Duralux || Maintenance Creative</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/vendors.min.css">
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/theme.min.css">
    <style>
        .maintenance-time {
            font-size: 75px;
            /* ⬅️ BESAR & JELAS */
            font-weight: 800;
            letter-spacing: 1px;
            line-height: 1;
            text-shadow: 0 2px 6px rgba(0, 0, 0, .08);

        }

        .maintenance-date {
            font-size: 15px;
            font-weight: 500;
            color: #6c757d;
        }

        @media (max-width: 576px) {
            .maintenance-time {
                font-size: 50px;
            }
        }
    </style>
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-creative-wrapper">
        <div class="auth-creative-inner">
            <div class="creative-card-wrapper">
                <div class="card my-4 overflow-hidden" style="z-index: 1">
                    <div class="row flex-1 g-0">
                        <div class="col-lg-6 h-100 my-auto">
                            <div
                                class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-50 start-50">
                                <img src="{{ asset('home/img/logo icon.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="creative-card-body card-body p-sm-5">
                                <h2 class="fs-20 fw-bolder mb-4">We’ll Be Right Back</h2>
                                <h4 class="fs-13 fw-bold mb-2">Our website is under maintenance</h4>
                                <p class="fs-12 fw-medium text-muted mb-4">
                                    Sorry for the inconvenience — we’re making some improvements behind the scenes.
                                    Please check back soon.
                                </p>
                                <div class="mt-4 pt-2 text-center">
                                    <div id="currentTime" class="maintenance-time"></div>
                                    <div id="currentDate" class="maintenance-date mt-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 bg-primary">
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('') }}admin/images/maintenance.png" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--! BEGIN: Vendors JS !-->
    <script src="{{ asset('') }}admin/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('') }}admin/js/common-init.min.js"></script>
    <script src="{{ asset('') }}admin/js/theme-customizer-init.min.js"></script>
    <script>
        function updateTime() {
            const now = new Date();

            const time = now.toLocaleTimeString('en-GB', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const date = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('currentTime').textContent = time;
            document.getElementById('currentDate').textContent = date;
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>

</body>

</html>
