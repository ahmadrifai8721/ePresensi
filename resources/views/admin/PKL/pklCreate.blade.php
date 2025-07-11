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
                    </div>

                    <div class="card-body pt-0">
                        <form action="{{ route('adminPKL.tambahpkl') }}" method="post">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="nama"
                                    placeholder="" />
                                <label for="floatingInput">Nama Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="alamat"
                                    placeholder="" />
                                <label for="floatingInput">Alamat Tempat PKL</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="no_telp"
                                    placeholder="" />
                                <label for="floatingInput">Nomer Telepon Tempat PKL</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingpenanggung_jawab" name="penanggung_jawab"
                                    placeholder="">
                                    <option selected disabled>Open this select menu</option>
                                    @forelse ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->nama }}
                                        </option>
                                    @empty
                                        <option>Guru Belum Di Import ke Databse Local</option>
                                    @endforelse
                                </select>
                                <label for="floatingpenanggung_jawab">Penanggung Jawab</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-soft-success rounded-pill">Simpan Data Tempat
                                    PKL</button>
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
