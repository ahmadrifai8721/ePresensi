@extends('admin/layout')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $pageTitle }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <h4 class="text-center">Absensi Kelas</h4>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Hadir">
                                    Hadir</h5>
                                <h3 class="mt-3 mb-3">{{ $Hadir->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-warning-lighten text-warning"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Jumalah Sakit">Sakit</h5>
                                <h3 class="mt-3 mb-3">{{ $Sakit->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-info-lighten text-info"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Jumlah Izin">Jumlah Izin</h5>
                                <h3 class="mt-3 mb-3">{{ $Izin->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-danger-lighten text-danger"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Jumlah Alfa">Jumlah Alfa</h5>
                                <h3 class="mt-3 mb-3">{{ $Alfa->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->
        </div>
        <div class="row">

            <h4 class="text-center">Absensi PKL</h4>
            <div class="col-xl-12 col-lg-12">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Hadir">
                                    Hadir</h5>
                                <h3 class="mt-3 mb-3">{{ $HadirPKL->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-warning-lighten text-warning"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Jumalah Sakit">Sakit</h5>
                                <h3 class="mt-3 mb-3">{{ $SakitPKL->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-info-lighten text-info"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Jumlah Izin">Jumlah Izin</h5>
                                <h3 class="mt-3 mb-3">{{ $IzinPKL->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-danger-lighten text-danger"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Jumlah Alfa">Jumlah Alfa</h5>
                                <h3 class="mt-3 mb-3">{{ $AlfaPKL->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">{{ $pageTitle }}</h4>
                        {{-- <a href="{{ Route('siswa.create') }}" class="btn btn-sm btn-light">Tambah siswa <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                    </div>

                    <div class="card-body pt-0">
                        <form>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control disabled" id="floatingInput"
                                    value="{{ $siswa->name }}" name="name" readonly />
                                <label for="floatingInput">Nama siswa</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingnisn"
                                    value="{{ $siswa->nisn }}" />
                                <label for="floatingnisn">nisn</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingKelas"
                                    value="{{ $siswa->mapingKelas->first()->Kelas->kelas }}" />
                                <label for="floatingKelas">Kelas</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" readonly class="form-control disabled" id="floatingKelas"
                                            value="{{ $siswa->mapingPKL->tempat->nama ?? 'Temapat PKL Belum Di isi' }}" />
                                        <label for="floatingKelas">Temapat PKL</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" readonly class="form-control disabled" id="floatingKelas"
                                            value="{{ $siswa->mapingPKL->tempat->penanggungJawab->nama ?? 'Temapat PKL Belum Di isi' }}" />
                                        <label for="floatingKelas">Penggung Jawab Temapat PKL</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingemail"
                                    value="{{ $siswa->User == null ? 'Siswa Belum Memiliki Akses Login' : $siswa->User->email }}" />
                                <label for="floatingemail">E-Mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatinpassword"
                                    value="{{ $siswa->User == null ? 'Siswa Belum Memiliki Akses Login' : ' NISN Siswa' }}" />
                                <label for="floatinpassword">Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingWalisiswa disabled" name="jk" disabled>
                                    <option value="L" {{ $siswa->jk == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                                    <option value="P" {{ $siswa->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <label for="floatingWalisiswa">Jenis Kelamin</label>
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('siswa.edit', $siswa->id) }}"
                                    class="btn btn-soft-info
                                rounded-pill">Edit Data
                                    siswa</a>
                                @if ($siswa->Users)
                                    <button type="button" class="btn btn-soft-secondary rounded-pill mt-3"
                                        data-bs-toggle="modal" data-bs-target="#showTokenModal{{ $siswa->User->id }}">
                                        <i class="mdi mdi-key"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="showTokenModal{{ $siswa->User->id }}" tabindex="-1"
                                        aria-labelledby="showTokenModalLabel{{ $siswa->User->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="showTokenModalLabel{{ $siswa->User->id }}">
                                                        User
                                                        Token
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                {{-- @dump($siswa->mobileAccess) --}}
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Token</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                id="tokenInput{{ $siswa->User->id }}"
                                                                value="{{ $siswa->User->mobileAccess->pin ?? 'No token yet' }}"
                                                                readonly>
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                onclick="copyToken{{ $siswa->User->id }}()">
                                                                Copy
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function copyToken{{ $siswa->User->id }}() {
                                                            const token = document.getElementById('tokenInput{{ $siswa->User->id }}').value;
                                                            navigator.clipboard.writeText(token).then(function() {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Copied!',
                                                                    text: 'Token copied to clipboard.',
                                                                    timer: 1500,
                                                                    showConfirmButton: false
                                                                });
                                                            });
                                                        }
                                                    </script>
                                                    <form id="generateTokenForm{{ $siswa->User->id }}" method="get">
                                                        @csrf
                                                        <button formaction="{{ route('Users.show', $siswa->User->id) }}"
                                                            type="submit" class="btn btn-primary w-100">Generate New
                                                            Token</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
