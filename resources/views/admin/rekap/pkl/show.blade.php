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
                        {{-- <a href="{{ Route('siswa.create') }}" class="btn btn-sm btn-light">Tambah siswa <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive" id="table">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Jumlah Siswa Yang Absen Hari Ini:
                                            {{ $totalSiswa }}</h5>
                                        <h5 class="font-14 my-1 fw-normal">Tempat PKL: {{ $Tempat->nama }}</h5>
                                    </td>
                                    <td>
                                    </td>
                                    <tr wire:loading>
                                        <td colspan="2">
                                            <h5 class="font-14 my-1 fw-bold text-center text-uppercase text-warning">Memuat
                                                Data</h5>
                                        </td>
                                    </tr>
                                    @forelse ($Tempat->mapingpkl as $item)
                                        <tr wire:loading.remove>
                                            @if ($item->siswa)
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                                    <span class="text-muted font-13">{{ $item->siswa->name }}</span>
                                                </td>
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">Presensi</h5>
                                                    @forelse ($item->siswa->presensiPKL as $presensi)
                                                        <span class="fw-normal font-13">
                                                            {{ $presensi->tanggal }}
                                                            <presensi class=" fw-bold"> : {{ $presensi->presensi }}
                                                            </presensi>
                                                        </span>
                                                        <br>
                                                    @empty
                                                        <span class="fw-bold font-13">Belum Absen</span>
                                                    @endforelse
                                                </td>
                                            @else
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                                    <span class="text-muted font-13">{{ $item->User->name }}</span>
                                                </td>
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">Presensi</h5>

                                                    <span class="fw-normal font-13">
                                                        {{ $item->presensi }}
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="font-14 my-1 fw-bold text-center text-uppercase text-danger">
                                                    Belum Ada Data</h5>
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
