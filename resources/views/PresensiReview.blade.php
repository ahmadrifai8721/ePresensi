<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Presensi {{ App\Models\Setting::first()->schoolName }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    @livewireStyles
</head>

<body>
    <div class="container-fluid !align !spacing p-5">
        <div class="card my-3">
            <div class="card-header" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">

            </div>
            <div class="card-body">
                <h1>E-Presensi {{ App\Models\Setting::first()->schoolName }}</h1>
                Apliksi Absensi Online Yang di Buat Untuk Tim Tata Tatip
            </div>
        </div>
        <div class="card my-3">

            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <strong> Data berhasil di kirim. </strong><br> Silahkan Hubungi Wali Kelas Atau Operator E-Presensi
                    jika
                    ada kesalahan memasukan data
                </div>
            </div>
        </div>

        <div class="card my-3" id="capture">
            <div class="card-body">
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
                                Kelas : {{ $kelas }}
                                <br>
                                Wali Kelas <strong>{{ $waliKelas }}</strong>
                                <br>
                                Mata Pelajaran : {{ $namaMapel }} ({{ $guruMapel }})
                                <br>
                                Presensi Guru : ({{ $guruPresensi }})
                            </td>
                            <td>{{ $Hadir }}</td>
                            <td>{{ $Sakit }}</td>
                            <td>{{ $Izin }}</td>
                            <td>{{ $Alfa }}</td>
                            <td>
                                Daftar nama siswa yang tidak masuk <br>
                                Sakit : <br>
                                <ol type="1">
                                    @foreach ($siswaSakit as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                                Izin : <br>
                                <ol type="1">
                                    @foreach ($siswaIzin as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                                Alfa : <br>
                                <ol type="1">
                                    @foreach ($siswaAlfa as $item)
                                    <li>{{ $item }}</li>
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
        </div>
        <a href="{{ route('home.index') }}" class="btn"
            style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);" type="submit">Back To Home</a>
        <a href="#capture" class="btn" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);"
            type="button" onclick="captureCanva()">Capture</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        function captureCanva(){

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
                createEl.download = "Bukti Absen Kelas <?= $kelas.'( '.$guruMapel.' ) tanggal '.Date('d-m-y H.i').'.jpeg'; ?>";
                createEl.click();
                createEl.remove();
                canvas.remove();
            });
            }
    </script>
    @livewireScripts
</body>

</html>
