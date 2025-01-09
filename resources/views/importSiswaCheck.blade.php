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
        <form action="/master/import/upload" method="post">

            @csrf
            <input type="hidden" name="code" value="{{ $code }}">

            <div class="card my-3">
                <div class="card-header" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">

                </div>
                <div class="card-body">
                    <h2>Mater Data E-Presensi {{ App\Models\Setting::first()->schoolName }}</h2>
                    Mengupdate master data dapat menghapus semua data
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <span style="font-size: 12pt">Rincian Data Pada Berkas Excel</span>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th scope="row">data siswa</th>
                                <th>data kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">{{ $count }}</td>
                                <td>{{ $kelas }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <span style="font-size: 12pt">Rincian Data Pada Database</span>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th scope="row">data siswa</th>
                                <th>data kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">{{ $dbcount }}</td>
                                <td>{{ $dbkelas }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn" type="submit"
                style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">Reset and Import</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
