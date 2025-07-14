<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light bg-light">
        <span class="logo-lg text-bold text-lg-center">
            <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
            {{ env('APP_NAME', 'KSOFT E - Presensi') }}
        </span>
        <span class="logo-sm text-bold text-lg-center">
            <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
            {{ env('APP_NAME', 'KSOFT E - Presensi') }}
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-lg text-bold text-lg-center">
            <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
            {{ env('APP_NAME', 'KSOFT E - Presensi') }}
        </span>
        <span class="logo-sm text-bold text-lg-center">
            <i class="mdi mdi-account-multiple-check" style="font-size: 2rem"></i>
            {{ env('APP_NAME', 'KSOFT E - Presensi') }}
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="https://ui-avatars.com/api/?name={{ $loginUser->name }}&background=random&size=500&rounded=true&bold=true"
                    alt="user-image" height="42" class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">{{ $loginUser->name }}</span>
            </a>
        </div>
        <!--- Sidemenu -->
        <ul class="side-nav">
            {{-- dasboard --}}
            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="uil-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            {{-- Isi Absen --}}
            <li class="side-nav-item">
                <a href="{{ route('home.index') }}" class="side-nav-link">
                    <i class="mdi mdi-account-multiple-check me-1"></i>
                    <span> Isi Absen </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('PKL.index') }}" class="side-nav-link">
                    <i class="mdi mdi-account-multiple-check me-1"></i>
                    <span> Isi Absen PKL</span>
                </a>
            </li>
            @if ($loginUser->UserRole->Role->role == 'Operator Sekolah' || $loginUser->UserRole->Role->role == 'Administrator')
                {{-- kelas --}}
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarKelas" aria-expanded="false" aria-controls="sidebarKelas"
                        class="side-nav-link">
                        <i class="mdi mdi-google-classroom"></i>
                        <span> Kelas </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarKelas">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{ route('kelas.index') }}">Daftar Kelas</a>
                            </li>
                            <li>
                                <a href="{{ route('kelas.create') }}">Tambah Kelas</a>
                            </li>
                            <li>
                                <a href="{{ route('pembelajaran.index') }}">Pembelajaran</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- adminPKL --}}
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebaradminPKL" aria-expanded="false"
                        aria-controls="sidebaradminPKL" class="side-nav-link">
                        <i class="mdi mdi-office-building-marker"></i>
                        <span> PKL </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebaradminPKL">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{ route('adminPKL.index') }}">Daftar PKL</a>
                            </li>
                            <li>
                                <a href="{{ route('adminPKL.create') }}">Tambah PKL</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- user --}}
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarsiswaGuru" aria-controls="sidebarsiswaGuru"
                        class="side-nav-link">
                        <i class="uil uil-graduation-hat"></i>
                        <span> Daftar User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse " id="sidebarsiswaGuru" style="">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarSiswa" aria-controls="sidebarSiswa"
                                    class="collapsed">
                                    <span> Siswa </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSiswa" style="">
                                    <ul class="side-nav-third-level">
                                        <li>
                                            <a href="{{ route('siswa.index') }}">Daftar Siswa</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('siswa.create') }}">Tamabah Siswa</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarguru" aria-controls="sidebarguru"
                                    class="collapsed">
                                    <span> Guru </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarguru" style="">
                                    <ul class="side-nav-third-level">
                                        <li>
                                            <a href="{{ route('guru.index') }}">Daftar Guru</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guru.create') }}">Tamabah Guru</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- userLogin --}}
                <li class="side-nav-item">
                    <a href="{{ route('Users.index') }}" class="side-nav-link">
                        <i class="mdi mdi-login-variant"></i>
                        <span> Daftar User Login </span>
                    </a>
                </li>
            @endif
            {{-- rekap --}}
            <li class=" side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span> Rekap </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        @if (
                            $loginUser->UserRole->Role->role == 'Operator Sekolah' ||
                                $loginUser->UserRole->Role->role == 'Administrator' ||
                                $loginUser->UserRole->Role->role == 'PTK' ||
                                $loginUser->UserRole->Role->role == 'Kepala Sekolah')
                            <li>
                                <a href="{{ route('rekapSiswa.index') }}">Siswa</a>
                            </li>
                            <li>
                                <a href="{{ route('rekapGuru.index') }}">Guru</a>
                            </li>
                            <li>
                                <a href="{{ route('rekapPKL.index') }}">PKL</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('rekapCetak.index') }}">Cetak</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if ($loginUser->UserRole->Role->role == 'Operator Sekolah' || $loginUser->UserRole->Role->role == 'Administrator')
                {{-- import Dapodik --}}
                <li class="side-nav-item">
                    <a href="{{ route('Dapodik.index') }}" class="side-nav-link">
                        <i class="mdi mdi-download"></i>
                        <span> Import Data Dari Dapodik </span>
                    </a>
                </li>
                {{-- setting --}}
                <li class="side-nav-item">
                    <a href="{{ route('setting.index') }}" class="side-nav-link">
                        <i class="uil-cog"></i>
                        <span> Setting </span>
                    </a>
                </li>
            @endif
            <!-- Help Box -->
            <div class="help-box text-white text-center">
                <a href="javascript: void(0);" class="float-end close-btn text-white">
                    <i class="mdi mdi-close"></i>
                </a>
                <img src="{{ url('/') }}/assets/images/svg/help-icon.svg" height="90"
                    alt="Helper Icon Image" />
                <h5 class="mt-3">Unlimited Access</h5>
                <p class="mb-3">Call Developer</p>
                <a href="javascript: void(0);" class="btn btn-secondary btn-sm">Call</a>
            </div>
            <!-- end Help Box -->


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
