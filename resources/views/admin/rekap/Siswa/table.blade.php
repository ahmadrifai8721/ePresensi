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
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <h5 class="font-14 my-1 fw-normal">Jumlah Siswa Yang Absen Hari Ini: {{
                                            $totalSiswa
                                            }}</h5>
                                    </td>
                                </tr>
                                @forelse ($siswa as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Kelas</h5>
                                        <span class="text-muted font-13">{{ $item->kelas }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Data Absensi</h5>
                                        <span class="text-muted font-13">Siswa : {{ $item->presensiSiswa->count()
                                            }}</span>
                                        {{-- <br>
                                        <span class="text-muted font-13">Guru : {{ $item->presensiGuru->count()
                                            }}</span> --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('rekapSiswa.show', $item->kelas) }}"
                                            class="btn btn-soft-primary font-13">List Data Absen per Mata Pelajaran</a>
                                        @if ($item->presensiSiswa->count() > 0) <a
                                            href="{{ route('rekapSiswaPerkelas', $item->kelas) }}"
                                            class="btn btn-soft-secondary  font-13">List Data Absen Keles</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama siswa Belum Ada</h5>
                                        <span class="text-muted font-13">Wali siswa Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di siswa</span>
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
