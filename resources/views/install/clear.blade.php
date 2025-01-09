@extends("install/Layout")
@section("auth")
<!--Auth fluid left content -->
<div class="auth-fluid-form-box bg-black">
    <div class="card-body d-flex flex-column h-100 gap-3">

        <!-- Logo -->
        <div class="auth-brand text-center text-lg-start">
            <img src="{{ url('/') }}/assets/images/ksof.png" width="100" alt="user-image">
        </div>

        <div>
            <!-- User pic with title-->
            <div class="text-center w-75 m-auto">
                <span class="logo-lg text-bold text-center text-primary ">
                    <i class="mdi mdi-account-multiple-check" style="font-size: 3rem"></i>
                    {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                </span>
                <h4 class="text-white text-center mt-3 fw-bold">Hi ! Administrator</h4>
                <p class="text-white text-capitalize mb-4">
                    <strong class="text-success text-uppercase">
                        register ready
                    </strong><br>
                    to use the E-Presence application.
                </p>
            </div>

            <!-- form -->
            <div class="mb-0 text-center d-grid">
                <a href="{{ route('login') }}" class="btn btn-primary"> <i class="mdi mdi-login"></i>Login
                </a>
            </div>
            <!-- end form-->
        </div>

        <!-- Footer-->
        <footer class="footer footer-alt">
            <script>
                document.write(new Date().getFullYear())
            </script> © {{ env('APP_NAME', 'KSOFT E - Presensi') }} - Ksoft.dev
        </footer>

    </div> <!-- end .card-body -->
</div>
<!-- end auth-fluid-form-box-->
@endsection