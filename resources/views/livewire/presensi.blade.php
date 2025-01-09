<div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Kelas</span>
            <div class="form-floating">
                <select class="form-select mt-3" id="kelas" wire:model="kelas" name="kelas" wire:change="findWaliKelas">
                    <option selected value="all">Pilih Kelas</option>
                    @foreach ($dataKelas as $item)
                    <option value="{{ $item->rombongan_belajar_id }}">{{ $item->kelas }}</option>
                    @endforeach
                </select>
                <label for="kelas">Pilih Kelas</label>
            </div>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Wali Kelas</span>
            <h6>{{ $Walikelas }}</h6>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Jam Pelajran Ke</span>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe1" type="checkbox" name="mapel[jamke][]"
                            value="1">
                        <label class="form-check-label" for="JamKe1">
                            1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe2" type="checkbox" name="mapel[jamke][]"
                            value="2">
                        <label class="form-check-label" for="JamKe2">
                            2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe3" type="checkbox" name="mapel[jamke][]"
                            value="3">
                        <label class="form-check-label" for="JamKe3">
                            3
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe4" type="checkbox" name="mapel[jamke][]"
                            value="4">
                        <label class="form-check-label" for="JamKe4">
                            4
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe5" type="checkbox" name="mapel[jamke][]"
                            value="5">
                        <label class="form-check-label" for="JamKe5">
                            5
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe6" type="checkbox" name="mapel[jamke][]"
                            value="6">
                        <label class="form-check-label" for="JamKe6">
                            6
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe7" type="checkbox" name="mapel[jamke][]"
                            value="7">
                        <label class="form-check-label" for="JamKe7">
                            7
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe8" type="checkbox" name="mapel[jamke][]"
                            value="8">
                        <label class="form-check-label" for="JamKe8">
                            8
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe9" type="checkbox" name="mapel[jamke][]"
                            value="9">
                        <label class="form-check-label" for="JamKe9">
                            9
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cb-jam" id="JamKe10" type="checkbox" name="mapel[jamke][]"
                            value="10">
                        <label class="form-check-label" for="JamKe10">
                            10
                        </label>
                    </div>
                </div>

                <!-- slider jam pelajaran -->
                <div class="m-auto" wire:ignore>
                    <label class="form-label" for="JamKe10">
                        masukan range jam mengajar
                    </label>
                    <input required type="text" id="range_jam" class="" />
                </div>
            </div>

        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Mata Pelajaran</span>
            <div class="form-floating mt-3">
                <select class="form-select mt-3" id="mapel" name="mapel[mapel]" wire:model='pembelajaran_id'
                    wire:change='guruMapelCheck'>
                    <option value="null" disabled>Pilih Mata Pelajaran</option>
                    @forelse ($dataMapel as $item)
                    <option value="{{ $item->pembelajaran_id }}">{{ $item->namaPelajaran }}</option>
                    @empty
                    <option selected disabled>Kelas Belum Di Pilih</option>
                    @endforelse
                </select>
                <label for="mapel">Mata Pelajaran</label>
            </div>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Nama Guru Yang Mengajar</span>
            <h6>{{ $namaGuruMapel }}</h6>
            <input required type="hidden" name="mapel[guru]" value="{{ $namaGuruMapel_ptk_id }}">
        </div>
    </div>
    @if ($namaGuruMapel_ptk_id)

    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Apakah Guru Pengajar Hadir</span>
            <div class="form-floating mt-3">
                <select class="form-select mt-3" id="PresensiGuru" name="mapel[presensi]" wire:model="presensiGuru"
                    wire:change="tugasCheck">
                    <option selected>Presensi</option>
                    <option>Hadir</option>
                    <option>Sakit</option>
                    <option>Izin</option>
                    <option>Alfa</option>
                    <option>Tugas</option>
                </select>
                <label for="floatingInput">Presensis Guru</label>
            </div>
        </div>
    </div>
    <div class="card my-3 @if (!$tugas) d-none @endif">
        <div class="card-body">
            <textarea name="mapel[tugas]" id="tugasGuru" cols="100" rows="10" style="height: 269px;"
                class="form-control" placeholder="Tugas Apa Dari Guru" onclick="set()"></textarea>
        </div>
    </div>
    @endif
    @if ($presensiGuru)

    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Daftar Siswa</span>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-default">
                    <tr>
                        <th>Nama</th>
                        <th class="d-none d-md-flex">JK</th>
                        <th class="d-none d-md-flex">NISN</th>
                        <th>Presensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataSiswa as $siswa)
                    {{-- @dd($siswa->Siswa->name) --}}
                    <tr>
                        <td>{{ $siswa->Siswa->name }}</td>
                        <td class="d-none d-md-flex">{{ $siswa->Siswa->jk }}</td>
                        <td class="d-none d-md-flex">{{ $siswa->Siswa->nisn }}</td>
                        <td>
                            <select class="form-select mt-3" id="Presensi"
                                name="presensi[{{ $siswa->Siswa->id }}][{{ $siswa->Siswa->name }}]">
                                <option>Hadir</option>
                                <option>Sakit</option>
                                <option>Izin</option>
                                <option>Alfa</option>
                            </select>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada siswa di kelas</td>

                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
