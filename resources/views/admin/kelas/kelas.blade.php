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
                    <a href="{{ Route('kelas.create') }}" class="btn btn-sm btn-light">Tambah Kelas <i
                            class="mdi mdi-plus ms-1"></i></a>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <td colspan="3">
                                    <h5 class="font-14 my-1 fw-normal"></h5>

                                </td>
                                @forelse ($kelas as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Tingkat {{ $item->tingkat }}</h5>
                                        <h5 class="font-14 my-1 fw-normal">{{ $item->kelas }}</h5>
                                        <span class="text-muted font-13">{{ $item->Guru->first()->nama }}</span>
                                    </td>
                                    <td>
                                        <br>
                                        <h5 class="font-14 my-1 fw-normal">{{ $item->mapingKelas->count() }}</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di kelas</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Action</h5>
                                        <form action="{{ route('kelas.destroy',$item->kelas) }}" method="post">
                                            <a href="{{ route('kelas.edit', $item->kelas) }}"
                                                class="btn btn-primary font-13">Edit</a>
                                            @if ($item->mapingKelas->count())
                                            <a href="{{ route('kelas.show',$item->kelas) }}"
                                                class="btn btn-secondary font-13">Daftar
                                                Siswa</a>
                                            @else
                                            <a href="{{ route('kelas.maping',$item->kelas) }}" class="btn btn-info
                                                        font-13">Tambah Siswa</a>
                                            @endif
                                            @method("delete")
                                            @csrf
                                            <button type="submit" class="btn btn-danger font-13">Hapus</button>
                                            <div class="my-3">
                                                <a href="{{ route('kelas.pembelajaran', $item->kelas) }}"
                                                    class="btn btn-dark font-13">Daftar Pembelajaran</a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama Kelas Belum Ada</h5>
                                        <span class="text-muted font-13">Wali Kelas Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di kelas</span>
                                    </td>
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
@include("admin/pagination")
