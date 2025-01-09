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
                    <a href="{{ Route('pembelajaran.create') }}" class="btn btn-sm btn-light">Tambah Pembelajaran <i
                            class="mdi mdi-plus ms-1"></i></a>
                </div>

                <div class="card-body pt-0">
                    <form>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control disabled" id="floatingInput"
                                value="{{ $pembelajaran->namaPelajaran }}" name="name" readonly />
                            <label for="floatingInput">Nama pelajaran</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control disabled" id="floatingnisn"
                                value="{{ $pembelajaran->kelas == null? " Kelas Telah di hapus" :
                                $pembelajaran->kelas->kelas }}" />
                            <label for="floatingkelas">kelas</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control disabled" id="floatingemail"
                                value="{{ $pembelajaran->guru == null? " guru Telah di hapus" :
                                $pembelajaran->guru->nama
                            }}" />
                            <label for="floatingemail">E-Mail</label>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('pembelajaran.edit',$pembelajaran->id) }}" class="btn btn-soft-info
                                rounded-pill">Edit Data pembelajaran</a>
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