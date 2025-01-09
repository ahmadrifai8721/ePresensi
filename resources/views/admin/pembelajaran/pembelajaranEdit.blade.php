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
                    <a href="{{ Route('pembelajaran.create') }}" class="btn btn-sm btn-light">Tambah pembelajaran <i
                            class="mdi mdi-plus ms-1"></i></a>
                </div>

                <div class="card-body pt-0">
                    <form action="{{ route('pembelajaran.update', $pembelajaran->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control disabled" readonly id="floatingInput"
                                value="{{ $pembelajaran->namaPelajaran }}" name="namaPelajaran" />
                            <label for="floatingInput">Nama pembelajaran</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="kelasPembelajran" name="kelas_id">
                                @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" {{ $pembelajaran->kelas_id == $item->id ? "selected":""
                                    }}>{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                            <label for="kelasPembelajran">Kelas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingWalipembelajaran" name="guruMapel">
                                @foreach ($guru as $item)
                                <option value="{{ $item->id }}" {{ $pembelajaran->guruMapel == $item->id ? "selected":""
                                    }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            </select>
                            <label for="floatingWalipembelajaran">Guru Yang Mengajar</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-soft-primary rounded-pill">Update Data
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
