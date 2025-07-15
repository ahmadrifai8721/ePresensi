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
                            @livewire('rekap-p-k-l', ['date' => $date])
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
