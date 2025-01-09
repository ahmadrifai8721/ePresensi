<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ route('dashboard') }}" class="logo-light">
                    <span class="logo-lg text-bold text-lg-center text-white">
                        <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
                        {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                    </span>
                    <span class="logo-sm text-bold text-lg-center text-white">
                        <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
                        {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="{{ route('dashboard') }}" class="logo-dark">
                    <span class="logo-lg text-bold text-lg-center ">
                        <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
                        {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                    </span>
                    <span class="logo-sm text-bold text-lg-center ">
                        <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
                        {{ env('APP_NAME', 'KSOFT E - Presensi') }}
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            @livewire('tobar-seacrh')
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">

            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line font-22"></i>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>


            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ $loginUser->name }}&background=random&size=500&bold=true"
                            alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">{{ $loginUser->name }}</h5>
                        <h6 class="my-0 fw-normal">{{$loginUser->UserRole->Role->role}}</h6>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>


                    {{--
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="mdi mdi-account-edit me-1"></i>
                        <span>Settings</span>
                    </a> --}}

                    <!-- item-->
                    <a href="{{ route('home.index') }}" class="dropdown-item">
                        <i class="mdi mdi-account-multiple-check me-1"></i>
                        <span>Isi Absen</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->