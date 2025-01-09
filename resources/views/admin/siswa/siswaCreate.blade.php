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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('siswa.store') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingname" name="name"
                                placeholder="Nama Lengkap" value="{{ old('name') }}" />
                            <label for="floatingname">Nama Siswa</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingnisn" name="nisn" placeholder=""
                                minlength="1" maxlength="16" value="{{ old('nisn') }}" />
                            <label for="floatingnisn">NISN</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingjk" name="jk" placeholder="">
                                <option selected></option>
                                <option {{ old("jk")=="L" ? "selected" : "" }} value="L">Laki - Laki</option>
                                <option {{ old("jk")=="P" ? "selected" : "" }} value="P">Perempuan</option>
                            </select>
                            <label for="floatingjk">Jenis Kelamin</label>
                        </div>

                        @livewire('tambah-siswa-baru',[
                        "kelas" => $kelas,
                        "oldtingkat" => old("Tingkat"),
                        "oldkelas" => old("kelas"),
                        ])
                        <div class="d-grid">
                            <button type="submit" class="btn btn-soft-success rounded-pill">Simpan Data Siswa</button>
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
