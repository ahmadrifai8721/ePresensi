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
                        <form action="{{ route('kelas.update', $kelas->kelas) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $kelas->kelas }}"
                                    name="kelas" />
                                <label for="floatingInput">Nama Kelas</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingtingkat"
                                    value="{{ $kelas->tingkat }}" />
                                <label for="floatingtingkat">tingkat</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" readonly class="form-control disabled" id="floatingjurusan"
                                    value="{{ $kelas->jurusan }}" />
                                <label for="floatingjurusan">jurusan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingWaliKelas" name="waliKelas">
                                    <option selected>Open this select menu</option>
                                    @forelse ($gurus as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ $guru->id == $kelas->waliKelas ? 'selected' : '' }}>{{ $guru->nama }}
                                        </option>
                                    @empty
                                        <option>Guru Belum Di Import Dari Dapodik atau Ditambahkan ke Databse Local</option>
                                    @endforelse
                                </select>
                                <label for="floatingWaliKelas">Wali Kelas</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-soft-primary rounded-pill">Update Data Kelas</button>
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
