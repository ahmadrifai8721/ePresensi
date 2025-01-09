<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true">

<head>
    <meta charset="utf-8" />
    <title>Login | {{ env('APP_NAME', 'Ksoft E - Presensi') }}</title>
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
</head>

<body class="authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="{{ route('dashboard') }}">
                                <span class="logo-lg text-bold text-lg-center text-light">
                                    <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
                                    {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                                </span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Login</h4>
                                <p class="text-muted mb-4">Masukan Username Dan Password
                                </p>
                            </div>

                            <form action="{{ route('Authentication.store') }}" method="POST">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" required name="email"
                                        placeholder="Enter your email">
                                </div>
                                @csrf
                                <div class="mb-3">
                                    <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your
                                            password?</small></a>
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password" name="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                            name="rememberme" value="true">
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                    @if (env("APP_INSTALL"))
                                    <a href="{{ route('install') }}" class="btn btn-secondary"> Install </a>
                                    @endif
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> © {{ env('APP_NAME', 'KSOFT E - Presensi') }} - Ksoft.dev
    </footer>
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
    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>

</body>

</html>
