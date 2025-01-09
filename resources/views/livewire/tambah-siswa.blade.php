<div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Semua Siswa</h4>

                    @if ($totalSiswa <= 0) <!-- Fullscreen Modal -->
                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal"
                            data-bs-target="#copyKelas">Copy Data Dari Kelas Lain
                            <i class="mdi mdi-archive-arrow-down ms-1"></i>
                        </button>
                        @endif
                        <div class="modal fade" id="copyKelas" tabindex="-1" aria-labelledby="copyKelasLabel"
                            aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="copyKelasLabel">Pilih Kelas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <select class="form-select mb-3" wire:model="kelasSelect"
                                                    wire:click='findKelas'>
                                                    <option selected>Pilih Kelas</option>
                                                    @foreach ($daftarKelas as $item)
                                                    <option value="{{ $item->rombongan_belajar_id }}">{{ $item->kelas }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <table class="table table-centered table-nowrap table-hover mb-0">
                                            <p>Kelas id : {{ $kelasSelect }} <br> Wali kelas : {{ $walikelas }}</p>
                                            <tbody>
                                                @forelse ($siswaSelect as $item)
                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">Name</h5>
                                                        <span class="text-muted font-13">{{ $item->name }}</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">NISN</h5>
                                                        <span class="text-muted font-13">{{ $item->nisn }}</span>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">Nama siswa Belum Ada</h5>
                                                        <span class="text-muted font-13">Wali siswa Belum Di Isi</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                                        <span class="text-muted font-13">Jumlah Siswa Di siswa</span>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:void(0);" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</a>
                                        <a type="button" class="btn btn-primary" wire:click="salinKelas">Tambahkan Ke
                                            kelas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <input type="text" name="cariSiswa" id="cariSiswa" wire:model="siswaCari"
                                class="form-control mb-3" wire:keyup="findSiswa"
                                placeholder="Maukan nama siswa atau nisn">
                            <tbody>
                                @forelse ($siswa as $item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Name</h5>
                                        <span class="text-muted font-13">{{ $item->name }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">NISN</h5>
                                        <span class="text-muted font-13">{{ $item->nisn }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Action</h5>
                                        <a href="#tambah" class="btn btn-primary font-13"
                                            wire:click="tambahSiswa('{{ $item->peserta_didik_id }}')">Tambahkan</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama siswa Belum Ada</h5>
                                        <span class="text-muted font-13">Wali siswa Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di siswa</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary font-13 disabled">Tambahkan</button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Siswa Di Kelas {{ $kelas->kelas }}</h4>
                    <a href="#update" class="btn btn-sm btn-light">Update Data
                        <i class="mdi mdi-reload ms-1" wire:click="updateData" wire:model='kelasSelect'></i>
                    </a>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @forelse ($siswaDikelas as $item)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Name</h5>
                                        <span class="text-muted font-13">{{ $item->name }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">NISN</h5>
                                        <span class="text-muted font-13">{{ $item->nisn }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Action</h5>
                                        <a href="#keluarkan" class="btn btn-danger font-13"
                                            wire:click="keluarkan('{{ $item->peserta_didik_id }}')">Hapus</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Nama siswa Belum Ada</h5>
                                        <span class="text-muted font-13">Wali siswa Belum Di Isi</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">***</h5>
                                        <span class="text-muted font-13">Jumlah Siswa Di siswa</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger font-13 disabled">Hapus</button>
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
</div>