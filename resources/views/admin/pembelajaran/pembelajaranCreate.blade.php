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
                    <form action="{{ route('pembelajaran.store') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingname" name="namaPelajaran"
                                placeholder="Nama Pelajaran" value="{{ old('namaPelajaran') }}" />
                            <label for="floatingname">Nama pelajaran</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingselect1" name="kelas_id" placeholder="">
                                @foreach ($kelas as $item)
                                <option {{ old("kelas_id")==$item->id ? "selected" : "" }} value="{{ $item->id
                                    }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                            <label for="floatingkelas_id">Kelas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingselect2" name="guruMapel" placeholder="">
                                @foreach ($guru as $item)
                                <option {{ old("guruMapel")==$item->id ? "selected" : "" }} value="{{ $item->id
                                    }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingguruMapel">Guru Mapel</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-soft-success rounded-pill">Simpan Data
                                pembelajaran</button>
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