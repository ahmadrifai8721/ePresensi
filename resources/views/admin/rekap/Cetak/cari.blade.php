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
                <div class="card-header">
                    {{-- <h4 class="header-title">{{ $pageTitle }}</h4> --}}
                    <a href="#print" class="btn btn-sm btn-secondary" onclick="captureCanva()">Save <i
                            class="mdi mdi-content-save ms-1"></i></a>
                </div>
                <div class="card-body" id="capture">
                    <table class="table table-striped table-bordered table-responsive">
                        <thead class="thead-default">
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle">Kelas</th>
                                <th style="text-align: center" colspan="4">Presensi</th>
                                <th style="text-align: center; vertical-align: middle" rowspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Kelas : {{ $presensiGuru->kelas->kelas }}
                                    <br>
                                    Wali Kelas <strong>{{ $presensiGuru->kelas->Guru->nama }}</strong>
                                    <br>
                                    Mata Pelajaran : {{ $presensiGuru->pembelajaran->namaPelajaran }} ({{
                                    $presensiGuru->Guru->nama
                                    }})
                                    <br>
                                    Presensi : {{ $presensiGuru->presensi }}
                                    @if ($presensiGuru->tugas)
                                    <br>
                                    {!! $presensiGuru->tugas !!}
                                    @endif
                                </td>
                                <td>{{ $Hadir}}</td>
                                <td>{{ $Sakit }}</td>
                                <td>{{ $Izin }}</td>
                                <td>{{ $Alfa }}</td>
                                <td>
                                    Daftar nama siswa yang tidak masuk <br>
                                    Sakit : <br>
                                    <ol type="1">
                                        @foreach ($siswaSakit as $item)
                                        <li>{{ $item->User->name }}</li>
                                        @endforeach
                                    </ol>
                                    Izin : <br>
                                    <ol type="1">
                                        @foreach ($siswaIzin as $item)
                                        <li>{{ $item->User->name }}</li>
                                        @endforeach
                                    </ol>
                                    Alfa : <br>
                                    <ol type="1">
                                        @foreach ($siswaAlfa as $item)
                                        <li>{{ $item->User->name }}</li>
                                        @endforeach
                                    </ol>
                                    Tanggal Cetak:
                                    {{ Date('d-m-y H.i') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    &copy; Tim Tatib <strong>{{ App\Models\Setting::first()->schoolName }}</strong>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

</div>
<!-- end row -->

</div>
<!-- container -->
@endsection
@section("pluginsJS")
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
    function captureCanva(){

        $("#light-dark-mode").click()

                html2canvas(document.querySelector("#capture"),{
                    allowTaint: true,
                    useCORS: true
                }).then(canvas => {
                console.log(canvas);
                document.body.appendChild(canvas)

                    let canvasUrl = canvas.toDataURL("image/jpeg", 0.5);
                    console.log(canvasUrl);
                    const createEl = document.createElement('a');
                    createEl.href = canvasUrl;
                    createEl.download = "Bukti Absen Mata Pelajaran <?= $presensiGuru->pembelajaran->namaPelajaran .'('. $presensiGuru->Guru->nama .') kelas '. $presensiGuru->kelas->kelas.'( '.$presensiGuru->kelas->Guru->nama.' ) tanggal '.Date('d-m-y H.i').'.jpeg'; ?>";
                    createEl.click();
                    createEl.remove();
                    canvas.remove();
                });

        $("#light-dark-mode").click()
                }
</script>
@endsection
