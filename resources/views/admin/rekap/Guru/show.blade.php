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
                                <td colspan="4">
                                    <h5 class="font-14 my-1 fw-normal">Jumlah Guru Yang Absen Hari Ini: {{
                                        $totalGuru
                                        }}</h5>
                                </td>
                                @forelse ($kelas->PresensiGuru as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                        <span class="text-muted font-13">{{ $item->Guru->nama }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama Pelajaran</h5>
                                        <span class="text-muted font-13">{{ $item->pembelajaran->namaPelajaran }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Presensi</h5>

                                        <span class="fw-bold font-13">{{ $item->presensi }}</span>

                                        @if ($item->presensi == "Tugas")
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-soft-info p-3" data-bs-toggle="modal"
                                            data-bs-target="#modalTugas-{{ $item->id }}">
                                            Lihat Tugas
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalTugas-{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="modalTugas-{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="modalTugas-{{ $item->id }}Label">
                                                            Tugas {{ $item->Guru->nama }} Kelas {{ $kelas->kelas }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $item->tugas !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        {{-- <button type="button"
                                                            class="btn btn-primary">Understood</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('rekapGuru.destroy',$item->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="fw-bold font-13 btn btn-soft-danger">Hapus
                                                Absensi</button>
                                        </form>

                                    </td>
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
                        </table> {{-- In work, do what you enjoy. --}}
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection