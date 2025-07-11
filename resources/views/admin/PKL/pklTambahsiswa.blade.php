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

        @livewire('tambah-siswa-p-k-l', ['pageTitle' => $pageTitle, 'TempatPKL' => $pkl, 'siswa' => $siswa])
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
