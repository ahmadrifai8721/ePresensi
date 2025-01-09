<tr>
    <td>
        <h5 class="font-14 my-1 fw-normal">Kelas</h5>
        <span class="text-muted font-13">{{ $dataKelas->kelas }}</span>
    </td>
    <td>
        <h5 class="font-14 my-1 fw-normal">Data Absensi</h5>
        <span class="text-muted font-13">Siswa : {{ $dataKelas->PresensiSiswa->count()
            }}</span>
        <br>
        <span class="text-muted font-13">Guru : {{ $dataKelas->PresensiGuru->count()
            }}</span>
    </td>
    <td>
        <button type="button" class="btn btn-soft-info p-3" data-bs-toggle="modal"
            data-bs-target="#modalCatak-{{ $dataKelas->id }}">
            Cetak
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalCatak-{{ $dataKelas->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="modalCatak-{{ $dataKelas->id }}Label" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCatak-{{ $dataKelas->id }}Label">
                            Cetak Absensi Kelas {{ $dataKelas->kelas
                            }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">
                            Pilih Periode
                        </h4>
                        <!-- Date Picker -->
                        <div class="mb-3 position-relative" id="datepicker-{{ $dataKelas->id }}">
                            <label class="form-label">Tangga</label>
                            <input type="text" class="form-control" data-provide="datepicker"
                                data-date-container="#datepicker-{{ $dataKelas->id }}" name="tanggal"
                                value="{{ $tanggal }}" onchange='cari("{{ $dataKelas->kelas }}",{{ $dataKelas->id }})'
                                id="tanggal-{{ $dataKelas->id }}" wire:model='tanggal'>
                        </div>
                        <small wire:model='tanggal'>rekap siswa tanggal {{ $tanggal }}</small>
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center fw-bold" rowspan="2">
                                        Mata Pelajaran</th>
                                    <th class="text-center fw-bold" colspan="3">
                                        Total Absensi</th>
                                    <th class="text-center fw-bold" rowspan="2">
                                        Cetak</th>
                                </tr>
                                <tr>
                                    <th class="text-center fw-bold">Presensi Guru</th>
                                    <th class="text-center fw-bold">Siswa</th>
                                    <th class="text-center fw-bold">Siswa per Mapel
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataPresensi as $key => $presensi)
                                {{-- @dump($presensi) --}}
                                <tr>
                                    <td class="text-center">{{ $presensi["namaMapel"] }}</td>
                                    <td class="text-center">{!! $presensi["presensi"] !!}</td>
                                    <td class="text-center">
                                        Hadir : {{ $presensi["Hadir"] }} <br>
                                        Sakit : {{ $presensi["Sakit"] }} <br>
                                        Izin : {{ $presensi["Izin"] }} <br>
                                        Alfa : {{ $presensi["Alfa"] }}
                                        <br>
                                    </td>
                                    <td class="text-center">{!! $presensi["kelas"] !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('rekapCetak.show',$presensi['Kode']) }}"
                                            class="btn btn-soft-info m-2"><i class="mdi mdi-printer"></i> Print
                                            Presensi
                                            Mapel</a>
                                        <a href="{{ route('rekapCetak.edit',$presensi['KodeKelas']) }}"
                                            class="btn btn-soft-info m-2"><i class="mdi mdi-printer"></i> Print
                                            Presensi
                                            Kelas</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center fw-bold">
                                        Tidak Di Temukan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </td>
    <script>
        function cari (kelas,id) {
            // console.log(kelas);
            // console.log(id);
            var date = new Date($('#tanggal-'+id).val()).toLocaleString("id-ID",{
                year: "numeric",
                month: "2-digit",
                day: "2-digit"
            })
            console.log(date);
            date = date.split(",")[0]

            $.get("/api/get/rekapKelas/"+kelas+"/"+date,
                function (data, textStatus, jqXHR) {
                    // console.log(data);
                    Livewire.emit("setdataPresensi",data)
                },
                "JSON"
            ).fail(function (e){
                Livewire.emit("setdataPresensi",null);

                Swal.fire({
                    title: e.responseText,
                    icon: "error",
                    timer: 1000,
                    animation: true,
                    // toast: true,
                    position: 'center',
                    showConfirmButton: false,
                })
            });
          }
    </script>
</tr>
