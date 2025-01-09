@extends("install/Layout")
@section("auth")
<!--Auth fluid left content -->
<div class="auth-fluid-form-box bg-black">
    <div class="card-body d-flex flex-column h-100 gap-3">

        <!-- Logo -->
        <div class="auth-brand text-center text-lg-start">

            <img src="{{ url('/') }}/assets/images/ksof.png" width="100" alt="user-image">
        </div>

        <div class="my-auto">
            <!-- User pic with title-->
            <div class="text-center w-75 m-auto">
                <span class="logo-lg text-bold text-center text-primary ">
                    <i class="mdi mdi-account-multiple-check" style="font-size: 3rem"></i>
                    {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                </span>
                <h4 class="text-white text-center mt-3 fw-bold">Hi ! partner </h4>
                <p class="text-white text-capitalize mb-4">register to use the E-Presence application.</p>
            </div>

            @if (session("reg"))
            <div class="alert alert-danger text-uppercase" role="alert">
                {{ session("reg") }}
            </div>
            @endif
            <!-- form -->
            <form action="{{ route('register') }}" method="post">

                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Email</label>
                            <input class="form-control text-dark" type="email" required="" id="email"
                                placeholder="Enter your E-mail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="dapo_ip" class="form-label text-white">IP Dapodik</label>
                            <input class="form-control text-dark" type="text" required="" id="dapo_ip"
                                placeholder="Enter your IP Dapodik" name="dapo_ip">
                        </div>
                        <div class="mb-3">
                            <label for="dapo_npsn" class="form-label text-white">NPSN</label>
                            <input class="form-control text-dark" type="text" required="" id="dapo_npsn"
                                placeholder="Enter your NPSN" name="dapo_npsn">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label text-white">Password</label>
                            <input class="form-control text-dark" type="text" required="" id="password"
                                placeholder="Enter your Password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="port" class="form-label text-white">Port Dapodik</label>
                            <input class="form-control text-dark" type="text" required="" id="port"
                                placeholder="Enter your port" name="dapo_port">
                        </div>
                        <div class="mb-3">
                            <label for="token" class="form-label text-white">Token</label>
                            <input class="form-control text-dark" type="text" required="" id="token"
                                placeholder="Enter your Dapodik token" name="dapo_token">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Koderegister" class="form-label text-white">Register code</label>
                        <input class="form-control text-dark" type="text" required="" id="Koderegister"
                            placeholder="Enter your Register code" name="code">
                    </div>
                    <div class="mb-0 text-center d-grid">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i>Register
                        </button>
                    </div>
                </div>
            </form>
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