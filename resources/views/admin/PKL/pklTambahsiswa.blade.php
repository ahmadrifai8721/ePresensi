@extends('admin/layout')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">


        @livewire('tambah-siswa-p-k-l', ['pageTitle' => $pageTitle, 'TempatPKL' => $pkl, 'siswa' => $siswa])
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
