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
            <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">{{ $pageTitle }}</h4>
                        {{-- <a href="{{ Route('siswa.create') }}" class="btn btn-sm btn-light">Tambah siswa <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                    </div>

                    <div class="card-body pt-0">
                        <form action="{{ route('siswa.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $siswa->name }}"
                                    name="name" />
                                <label for="floatingInput">Nama siswa</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingnisn"
                                    value="{{ $siswa->nisn }}" />
                                <label for="floatingnisn">nisn</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingkelas"
                                    value="{{ $siswa->mapingKelas->first()->Kelas->kelas }}" />
                                <label for="floatingkelas">Kelas</label>
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
                                <select class="form-select" id="floatingWalisiswa" name="jk">
                                    <option value="L" {{ $siswa->jk == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                                    <option value="P" {{ $siswa->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <label for="floatingWalisiswa">Jenis Kelamin</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-soft-primary rounded-pill">Update Data siswa</button>
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
