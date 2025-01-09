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
                    <a href="{{ Route('kelas.create') }}" class="btn btn-sm btn-light">Tambah Kelas <i
                            class="mdi mdi-plus ms-1"></i></a>
                </div>

                <div class="card-body pt-0">
                    <form action="{{ route('kelas.store') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="kelas" placeholder="" />
                            <label for="floatingInput">Nama Kelas</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingtingkat" name="tingkat" placeholder="">
                                <option>Kelas 10</option>
                                <option>Kelas 11</option>
                                <option>Kelas 12</option>
                            </select>
                            <label for="floatingtingkat">Tingkat</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingWaliKelas" name="waliKelas" placeholder="">
                                <option>Open this select menu</option>
                                @forelse ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan_id_str }}
                                </option>
                                @empty
                                <option>Jurusan Belum Di Import Dari Dapodik atau Ditambahkan ke Databse Local</option>
                                @endforelse
                            </select>
                            <label for="floatingWaliKelas">Jurusan</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingWaliKelas" name="waliKelas" placeholder="">
                                <option>Open this select menu</option>
                                @forelse ($gurus as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}
                                </option>
                                @empty
                                <option>Guru Belum Di Import ke Databse Local</option>
                                @endforelse
                            </select>
                            <label for="floatingWaliKelas">Wali Kelas</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-soft-success rounded-pill">Simpan Data Kelas</button>
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