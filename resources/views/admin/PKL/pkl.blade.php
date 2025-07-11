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
                        <a href="{{ Route('adminPKL.create') }}" class="btn btn-sm btn-light">Tambah pkl <i
                                class="mdi mdi-plus ms-1"></i></a>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive" id="table">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    <td colspan="3">
                                        <h5 class="font-14 my-1 fw-normal"></h5>

                                    </td>
                                    @forelse ($pkl as $item)
                                        <tr>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">{{ $item->nama }}</h5>
                                                <span class="text-muted font-13">{{ $item->penanggungJawab->nama }}</span>
                                            </td>
                                            <td>
                                                <br>
                                                <h5 class="font-14 my-1 fw-normal">{{ $item->mapingpkl->count() }}</h5>
                                                <span class="text-muted font-13">Jumlah Siswa Di Tempat PKL</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Action</h5>
                                                <form action="{{ route('adminPKL.destroy', $item->id) }}" method="post">
                                                    <a href="{{ route('adminPKL.edit', $item->id) }}"
                                                        class="btn btn-primary font-13">Edit</a>
                                                    @if ($item->mapingpkl->count())
                                                        <a href="{{ route('adminPKL.show', $item->id) }}"
                                                            class="btn btn-secondary font-13">Daftar
                                                            Siswa</a>
                                                    @else
                                                        <a href="{{ route('adminPKL.maping', $item->id) }}"
                                                            class="btn btn-info
                                                        font-13">Tambah
                                                            Siswa</a>
                                                    @endif
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger font-13">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td rowspan="2">
                                                <h5 class="font-14 my-1 fw-normal">Data Tempat PKL Belum ada</h5>
                                                <span class="text-muted font-13">Penanggung Jawab PKL Belum Di Isi</span>
                                            </td>
                                            <td>

                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Action</h5>
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
