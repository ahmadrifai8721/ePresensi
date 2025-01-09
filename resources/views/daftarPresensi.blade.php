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
                <table class="table table-striped table-bordered table-responsive">
                    <thead class="thead-default">
                        <tr>
                            <th>No.</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $item)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->waliKelas }}</td>
                                <td>
                                    <a href="{{ route('kelas.edit', $item->kelas) }}" class="btn btn-sm right"
                                        style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);"
                                        data-bs-toggle="modal" data-bs-target="#Edit-{{ $loop->index }}">Edit</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="Edit-{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="EditLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="EditLabel">Edit Kelas</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @livewire('edit-kelas', [
                                                        'kelas' => $item->kelas,
                                                        'waliKelas' => $item->waliKelas,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Kelas Belum di Import
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('home.index') }}" class="btn"
            style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);" type="submit">Back To Home</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
