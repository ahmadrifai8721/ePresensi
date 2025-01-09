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
                    {{-- <a href="{{ Route('Guru.create') }}" class="btn btn-sm btn-light">Tambah Guru <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <td colspan="3">
                                    <h5 class="font-14 my-1 fw-normal">Jumlah Guru Yang Absen Hari Ini: {{ $totalGuru
                                        }}</h5>
                                </td>
                                @forelse ($Guru as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Kelas</h5>
                                        <span class="text-muted font-13">{{ $item->kelas }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Data Absensi</h5>
                                        <span class="text-muted font-13">Guru : {{ $item->presensiGuru->count()
                                            }}</span>
                                        {{-- <br>
                                        <span class="text-muted font-13">Guru : {{ $item->presensiGuru->count()
                                            }}</span> --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('rekapGuru.show', $item->kelas) }}"
                                            class="btn btn-primary font-13">List Data Absen</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama Guru Belum Ada</h5>
                                        <span class="text-muted font-13">Wali Guru Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Guru Di Guru</span>
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
@include('admin/pagination')