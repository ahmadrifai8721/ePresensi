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
                            <input type="text" readonly class="form-control disabled" id="floatingemail"
                                value="{{ $siswa->User == null ? 'Siswa Belum Memiliki Akses Login' : $siswa->User->email }}" />
                            <label for="floatingemail">E-Mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control disabled" id="floatinpassword"
                                value="{{ $siswa->User == null ? 'Siswa Belum Memiliki Akses Login' : " NISN Siswa"
                                }}" />
                            <label for="floatinpassword">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingWalisiswa disabled" name="jk" disabled>
                                <option value="L" {{ $siswa->jk == "L"? "selected":"" }}>Laki - Laki</option>
                                <option value="P" {{ $siswa->jk == "P"? "selected":"" }}>Perempuan</option>
                            </select>
                            <label for="floatingWalisiswa">Jenis Kelamin</label>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('siswa.edit',$siswa->id) }}" class="btn btn-soft-info
                                rounded-pill">Edit Data siswa</a>
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
