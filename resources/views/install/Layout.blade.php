<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true">

<head>
    <meta charset="utf-8" />
    <title>Register System E-Presensi</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ url('/') }}/assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="{{ url('/') }}/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg pb-0">

    <div class="auth-fluid"
        style="background: url({{ url('/') }}/assets/images/bg-reg.jpg) center;background-size: cover;">
        <!--Auth fluid left content -->
        @yield("auth")
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center ">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">E - Presensi</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Web APP For Student Attendance. <i
                        class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - KSoft
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="{{ url('/') }}/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>

</body>

</html>