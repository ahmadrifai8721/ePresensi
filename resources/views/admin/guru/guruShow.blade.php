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
                    <h4 class="header-title">Kalender Kehadiran</h4>
                    {{-- <a href="{{ Route('guru.create') }}" class="btn btn-sm btn-light">Tambah Guru <i
                        class="mdi mdi-plus ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <div id="calender">
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">{{ $pageTitle }}</h4>
                    {{-- <a href="{{ Route('guru.create') }}" class="btn btn-sm btn-light">Tambah Guru <i
                        class="mdi mdi-plus ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <form>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control disabled" id="floatingInput"
                                value="{{ $Guru->nama }}" name="nama" readonly />
                            <label for="floatingInput">Nama Guru</label>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('guru.edit',$Guru->id) }}" class="btn btn-soft-info
                                rounded-pill">Edit Data Guru</a>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection
@section("plunginCSS")
<!-- Fullcalendar css -->
<link href="{{ url('/') }}/assets/vendor/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />
@endsection
@section("pluginsJS")
<!-- Fullcalendar js -->
<script src="{{ url('/') }}/assets/vendor/fullcalendar/main.min.js"></script>

<script>
    $(document).ready(function () {


        var el = document.getElementById("calender");
        console.log(el);
        var calendar = new FullCalendar.Calendar(el, {
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
            },
             events: {
                url: '{{ route("api.presensiGuru",$Guru->id) }}'
             }
        });
        calendar.setOption('locale', 'id');
        calendar.render();
    })

</script>

@endsection
