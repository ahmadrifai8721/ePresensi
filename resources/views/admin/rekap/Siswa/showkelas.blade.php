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
                    {{-- <a href="{{ Route('Siswa.create') }}" class="btn btn-sm btn-light">Tambah Siswa <i
                            class="mdi mdi-plus ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <td colspan="4">
                                    <h5 class="font-14 my-1 fw-normal">Jumlah Siswa Yang Absen Hari Ini: {{
                                        $totalSiswa
                                        }}</h5>
                                </td>
                                @forelse ($kelas as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                        <span class="text-muted font-13">{{ $item->User->name }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Presensi</h5>

                                        <form action="{{ route('rekapSiswa.update',$item->siswa_id) }}" method="post"
                                            class="d-flex">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <select class="form-select mt-3 mx-2" id="Presensi" name="presensi">
                                                <option {{ $item->presensi=="Hadir" ? "selected" : "" }}>Hadir
                                                </option>
                                                <option {{ $item->presensi=="Sakit" ? "selected" : "" }}>Sakit
                                                </option>
                                                <option {{ $item->presensi=="Izin" ? "selected" : "" }}>Izin
                                                </option>
                                                <option {{ $item->presensi=="Alfa" ? "selected" : "" }}>Alfa
                                                </option>
                                            </select>
                                            <button type="submit"
                                                class="fw-bold font-13 btn btn-soft-warning">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('rekapSiswa.destroy',$item->siswa_id) }}" method="post">
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