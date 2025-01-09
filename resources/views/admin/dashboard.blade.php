@extends('admin/layout')

@section('pluginsCSS')
@endsection

@section('pluginsJS')
<!-- Apex Chart js -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script>
    var options = {
            series: [{!! $guruHadir !!}, {!! $guruSakit !!}, {!! $guruIzin !!}, {!! $guruAlfa !!},{!! $guruTugas !!}],
            chart: {
                height: 350,
                type: 'radialBar',
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 225,
                    hollow: {
                        margin: 0,
                        size: '70%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: '#888',
                            fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val);
                            },
                            color: '#111',
                            fontSize: '36px',
                            show: true,
                        },
                        total: {
                            show: true,
                            label: 'Total Sudah Absen',
                            formatter: function(w) {
                                var i = 0;
                                w.config.series.forEach(element => {
                                    i = i + element;
                                    console.log(i);
                                });
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return i
                            }
                        }
                    }
                }
            },
            stroke: {
                lineCap: 'round'
            },
            labels: ['Hadir', "Sakit", "Izin", "Alfa","Tugas"],
        };

        var chart = new ApexCharts(document.querySelector("#kehadiran-guru"), options);
        chart.render();
</script>
{{-- kehadiran siswa --}}
<script>
    var options = {
            series: [{!! $hadirHariIni !!}, {!! $sakitHariIni !!}, {!! $izinHariIni !!}, {!! $alfaHariIni !!}],
            chart: {
                height: 350,
                type: 'radialBar',
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 225,
                    hollow: {
                        margin: 0,
                        size: '70%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: '#888',
                            fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val);
                            },
                            color: '#111',
                            fontSize: '36px',
                            show: true,
                        },
                        total: {
                            show: true,
                            label: 'Total Sudah Absen',
                            formatter: function(w) {
                                var i = 0;
                                w.config.series.forEach(element => {
                                    i = i + element;
                                    console.log(i);
                                });
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return i
                            }
                        }
                    }
                }
            },
            stroke: {
                lineCap: 'round'
            },
            labels: ['Hadir', "Sakit", "Izin", "Alfa"],
        };

        var chart = new ApexCharts(document.querySelector("#kehadiran-siswa"), options);
        chart.render();
</script>
@endsection

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
        <div class="col-xl-6 col-lg-12">

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Kelas Sudah Absen">
                                Kelas Sudah Absen</h5>
                            <h3 class="mt-3 mb-3">{{ $kelasSudahAbsen }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2">
                                    {{ $kelasBelumAbsen }}</span>
                                <span class="text-nowrap">Belum Absen</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Jumalah Alfa">Guru Hadir</h5>
                            <h3 class="mt-3 mb-3">{{ $guruHadir }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2">
                                    {{ $kelasBelumAbsen }}</span>
                                <span class="text-nowrap">Belum Absen</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average Jumlah Sakit">Jumlah hadir</h5>
                            <h3 class="mt-3 mb-3">{{ $hadirTotal }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2">{{ $hadirHariIni }}</span>
                                <span class="text-nowrap">Pada Hari Ini</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-warning-lighten text-warning"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Jumlah Sakit">Jumlah Sakit</h5>
                            <h3 class="mt-3 mb-3">{{ $sakitTotal }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-warning me-2">
                                    {{ $sakitHariIni }}</span>
                                <span class="text-nowrap">Pada Hari Ini</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

        </div> <!-- end col -->
        <div class="col-xl-6 col-lg-12">

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-warning-lighten text-warning"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Guru Tidak Hadir">
                                Guru Tidak Hadir</h5>
                            <h3 class="mt-3 mb-3">{{ $guruAlfa + $guruSakit + $guruIzin }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2">
                                    {{ $kelasBelumAbsen }}</span>
                                <span class="text-nowrap">Belum Absen</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-danger-lighten text-danger"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Guru Tugas">Guru Tugas</h5>
                            <h3 class="mt-3 mb-3">{{ $guruTugas }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2">
                                    {{ $kelasBelumAbsen }}</span>
                                <span class="text-nowrap">Belum Absen</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-info-lighten text-info"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average Jumlah izin">Jumlah izin</h5>
                            <h3 class="mt-3 mb-3">{{ $izinTotal }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-info me-2">{{ $izinHariIni }}</span>
                                <span class="text-nowrap">Pada Hari Ini</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-danger-lighten text-danger"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Jumlah Alfa">Jumlah Alfa</h5>
                            <h3 class="mt-3 mb-3">{{ $alfaTotal }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2">
                                    {{ $alfaHariIni }}</span>
                                <span class="text-nowrap">Pada Hari Ini</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">

        <div class="col-xl-6 col-lg-6">
            <div class="card card-h-100">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Presentase Kehadiran Siswa Hari Ini</h4>
                </div>
                <div class="card-body pt-0">
                    <div dir="ltr">
                        <div id="kehadiran-siswa" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div> <!-- end col -->
        <div class="col-xl-6 col-lg-6">
            <div class="card card-h-100">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Presentase Kehadiran Guru Hari Ini</h4>
                </div>
                <div class="card-body pt-0">
                    <div dir="ltr">
                        <div id="kehadiran-guru" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Presensi Guru</h4>
                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i
                            class="mdi mdi-download ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive" style="max-height: 320px;height: 320px;">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @forelse ($presensiGuru as $data)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama Guru</h5>
                                        <span class="text-muted font-13">{{ $data->Guru->nama }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Mata Pelajran</h5>
                                        <span class="text-muted font-15 fw-bold">{{ $data->pembelajaran->namaPelajaran
                                            }}</span>
                                        <br>
                                        @foreach (json_decode($data->jamke) as $jam)
                                        <span class="badge bg-info rounded-pill">{{ $jam }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Kelas</h5>
                                        <span class="text-muted font-13">{{ $data->kelas->kelas }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Tanggal</h5>
                                        <span class="text-muted font-13">
                                            {{ $data->tanggal }}

                                        </span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Kehadiran</h5>
                                        <span class="font-16 fw-bold">{{ $data->presensi }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <h5 class="font-14 my-1 fw-normal text-capitalize">belum ada data presensi</h5>
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