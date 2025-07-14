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
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body pt-0">

                        <div class="table-responsive" id="table">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    <tr>

                                        <td colspan="4">
                                            <h5 class="font-14 my-1 fw-normal">Jumlah Siswa :
                                                {{ $totalSiswa }}</h5>
                                            <h5 class="font-14 my-1 fw-normal">Mata Pelajaran: {{ $tempat->nama }}
                                            </h5>
                                        </td>
                                    </tr>

                                    @forelse ($presensi as $item)
                                        {{-- @dd($item) --}}
                                        <tr>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                                <span class="text-muted font-13">{{ $item->siswa->name }}</span>
                                                <h5 class="font-14 my-1 fw-normal">Tanggal</h5>
                                                <span class="text-muted font-13">{{ $item->tanggal }}</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Bukti</h5>
                                                <img src="{{ asset('storage/buktiPresensiPKL') . '/' . $item->bukti }}"
                                                    alt="" width="100" style="cursor: zoom-in"
                                                    onclick="window.open(this.src, '_blank')" />
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Presensi</h5>
                                                <form action="{{ route('PKL.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="fw-normal font-13 d-flex" class="d-flex">
                                                        <select class="form-select mt-3 mx-2" id="Presensi"
                                                            name="presensi" wire:model="presensi">
                                                            <option {{ $item->presensi == 'Hadir' ? 'selected' : '' }}>
                                                                Hadir
                                                            </option>
                                                            <option {{ $item->presensi == 'Sakit' ? 'selected' : '' }}>
                                                                Sakit
                                                            </option>
                                                            <option {{ $item->presensi == 'Izin' ? 'selected' : '' }}>
                                                                Izin
                                                            </option>
                                                            <option {{ $item->presensi == 'Alfa' ? 'selected' : '' }}>
                                                                Alfa
                                                            </option>
                                                        </select>
                                                        @csrf
                                                        <button type="submit" class="btn btn-soft-info">Update
                                                            data</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-soft-danger" title="Hapus"
                                                        formaction="{{ route('PKL.destroy', $item->id) }}"
                                                        formmethod="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
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
