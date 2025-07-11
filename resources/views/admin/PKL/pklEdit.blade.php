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
                        <a href="{{ Route('adminPKL.create') }}" class="btn btn-sm btn-light">Tambah pkl <i
                                class="mdi mdi-plus ms-1"></i></a>
                    </div>

                    <div class="card-body pt-0">
                        <form action="{{ route('adminPKL.update', $pkl->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $pkl->nama }}"
                                    name="nama" />
                                <label for="floatingInput">Nama Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $pkl->alamat }}"
                                    name="alamat" />
                                <label for="floatingInput">Alamat Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $pkl->no_telp }}"
                                    name="no_telp" />
                                <label for="floatingInput">No Telepon Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" value="{{ $pkl->email }}"
                                    name="email" />
                                <label for="floatingInput">Email Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $pkl->website }}"
                                    name="website" />
                                <label for="floatingInput">Website Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingWalipkl" name="walipkl">
                                    <option selected>Open this select menu</option>
                                    @forelse ($gurus as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ $guru->id == $pkl->penanggung_jawab ? 'selected' : '' }}>
                                            {{ $guru->nama }}
                                        </option>
                                    @empty
                                        <option>Guru Belum Di Import Dari Dapodik atau Ditambahkan ke Databse Local</option>
                                    @endforelse
                                </select>
                                <label for="floatingWalipkl">Penanggung Jawab</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-soft-primary rounded-pill">Update Data pkl</button>
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
