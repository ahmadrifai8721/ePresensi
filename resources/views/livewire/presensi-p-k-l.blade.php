<div>

    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Tempat PKL</span>
            <div class="form-floating mt-3">
                <select class="form-select mt-3" id="mapel" name="tempat_p_k_l_id" wire:model='tempatPKLselect'
                    wire:change='PJCheck'>
                    <option value="null" selected>Pilih Tempat PKL</option>
                    @forelse ($tempatPKL as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @empty
                        <option selected disabled>Kelas Belum Di Pilih</option>
                    @endforelse
                </select>
                <label for="mapel">Tempat PKL</label>
            </div>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Penanggung Jawab</span>
            <h6>{{ $namaPJ }}</h6>
        </div>
    </div>
    @if ($namaPJ)
        <div class="card my-3">
            <div class="card-body">
                <span style="font-size: 12pt">Nama Siswa</span>
                <div class="form-floating mt-3">
                    <select class="form-select mt-3" id="siswa_id" name="siswa_id" wire:model.live='siswa_id'
                        wire:change='siswaCheck'>
                        <option value="null" selected>Pilih Nama Siswa</option>
                        @forelse ($dataSiswa as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @empty
                            <option selected disabled>Kelas Belum Di Pilih</option>
                        @endforelse
                    </select>
                    <label for="mapel">Nama Siswa</label>
                </div>
            </div>
        </div>
    @endif

    @if ($siswa_id_check)
        <div class="card my-3">
            <div class="card-body">
                <span style="font-size: 12pt">Apakah Hadir Hari ini</span>
                <div class="form-floating mt-3">
                    <select class="form-select mt-3" id="PresensiGuru" name="presensi" wire:model="presensi">
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
    @elseif ($sudahAbsen)
        <div class="card my-3">
            <div class="card-header text-center"
                style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">
                <h1>Maaf
                    <br>
                    Anda Sudah pernah absen Hari ini
                </h1>
            </div>
            <div class="card-body text-danger text-center fw-bold text-capitalize">
                Untuk Mengubah data absensensi silahkan hubungi pembimbing atau Penenggung jawab
            </div>
        </div>
    @endif
    @if ($presensi)
        <div class="card my-3">
            <div class="card-body">
                <span style="font-size: 12pt">Upload File Presensi (Gambar Saja)</span>
                <div class="form-floating mt-3">
                    <input type="file" class="form-control" id="presensi_file" name="presensi_file" accept="image/*"
                        onchange="previewImage(event)">
                    <label for="presensi_file">Pilih File Gambar</label>
                </div>
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <img id="previewImg" src="#" alt="Preview" class="img-fluid mt-2"
                        style="max-height: 300px;">
                </div>
                <div id="fileError" class="text-danger mt-2" style="display: none;"></div>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button class="btn" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);"
                type="submit">Kirim</button>
        </div>
    @endif
</div>
