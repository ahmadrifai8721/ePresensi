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


                <div class="card-body pt-0">
                    <div class="table-responsive" id="table">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <div class="d-flex card-header justify-content-between align-items-center">
                                            <h4 class="header-title">{{ $pageTitle }}</h4>
                                            <a href="{{ Route('kelas.maping',$kelas_id) }}"
                                                class="btn btn-sm btn-light">Tambah
                                                Siswa <i class="mdi mdi-plus ms-1"></i></a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Siswa as $index => $item)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                        <span class="text-muted font-13">{{ $item->name }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">NISN</h5>
                                        <span class="text-muted font-13">{{ $item->nisn }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('kelas.store') }}" method="post">
                                            <h5 class="font-14 my-1 fw-normal">Action</h5>

                                            <a href="{{ route('siswa.edit',$item->id) }}"
                                                class="btn btn-primary font-13">Edit</a>

                                            @csrf
                                            <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                            <input type="hidden" name="pd_id" value="{{ $item->peserta_didik_id }}">
                                            <button type="submit" class="btn btn-danger font-13">Keluarkan dari
                                                Rombel</button>
                                        </form>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama Siswa Belum Ada</h5>
                                        <span class="text-muted font-13">Wali Siswa Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di Siswa</span>
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
@include('admin/pagination')
