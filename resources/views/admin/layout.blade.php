<!DOCTYPE html>
<html lang="en" data-layout-mode="detached">

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle }} | {{ env('APP_NAME', 'Ksoft E - Presensi') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico">


    <!-- Theme Config Js -->
    <script src="{{ url('/') }}/assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="{{ url('/') }}/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    @livewireStyles
    @yield('plunginCSS')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        @php
        $loginUser = Auth::user();
        @endphp
        @include('admin/topbar')

        @if ($loginUser->UserRole->Role->role == "Peserta Didik")
        @else
        @include('admin/leftMenu')
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Kfost Team Koala
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        @endif

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

        @include("admin/themeSetting")

    <!-- Vendor js -->
    <script src="{{ url('/') }}/assets/js/vendor.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
        Swal.fire({
                title: "<?= session('success') ?>",
                icon: "success",
                timer: 3000,
                animation: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            })
    </script>
    @endif
    @if (session('danger'))
    <script>
        Swal.fire({
                title: "<?= session('danger') ?>",
                icon: "error",
                timer: 3000,
                animation: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            })
    </script>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/wxtan2/Client-Side-Table-Pagination/table-pagination.js"></script>
    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>
    @livewireScripts
    @yield('pluginsJS')

</body>

</html>
