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
                    {{-- <a href="{{ Route('Kelas.create') }}" class="btn btn-sm btn-light">Tambah Kelas <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <td colspan="3">

                                </td>
                                @forelse ($Kelas as $item)
                                <livewire:rekap-cetak :dataKelas="$item" wire:key="$loop->index">
                                    @empty
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">Nama Kelas Belum Ada</h5>
                                            <span class="text-muted font-13">Wali Kelas Belum Di Isi</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">***</h5>
                                            <span class="text-muted font-13">Jumlah Kelas Di Kelas</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary font-13 disabled">Edit</button>
                                            <button class="btn btn-danger font-13 disabled">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection
@section("pluginsCSS")
<!-- Bootstrap Datepicker css -->
<link href="{{ url('/') }}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
    type="text/css" />
@endsection
@section("pluginsJS")

<!-- Bootstrap Datepicker js -->
<script src="{{ url('/') }}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


@endsection
@include('admin/pagination')
