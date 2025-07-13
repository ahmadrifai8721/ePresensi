<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $pageTitle }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Semua Siswa</h4>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <div class="my-2">
                            <select id="TempatPKLSelect" class="form-select" wire:model="TempatPKLSelect"
                                wire:change='findTempatPKL'>
                                <option value="">-- Pilih Tempat PKL --</option>
                                @foreach ($daftarTempatPKL as $tempat)
                                    <option value="{{ $tempat->id }}">{{ $tempat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="cariSiswa" id="cariSiswa" wire:model.live="siswaCari"
                            class="form-control mb-3" wire:keyup="findSiswa"
                            placeholder="Masukkan nama siswa atau nisn">
                        <table class="table table-centered table-nowrap table-hover mb-0" wire:ignore.self>
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
                                                wire:click="tambahSiswa('{{ $item->id }}')">Tambahkan</a>
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
        <div class="col-xl-4 col-lg-4 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Siswa Di TempatPKL {{ $TempatPKL->TempatPKL }}</h4>
                    <a href="#update" wire:click="updateData()" wire:loading.remove class="btn btn-sm btn-light">Update
                        Data
                        <i class="mdi mdi-reload ms-1" wire:click="updateData" wire:model='TempatPKLSelect'></i>
                    </a>
                    <a wire:loading wire:target='updateData()'class="btn btn-sm btn-light">Update
                        Data
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    </a>

                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @forelse ($siswaDiTempatPKL as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">Name</h5>
                                            <span class="text-muted font-13">{{ $item['name'] }}</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">NISN</h5>
                                            <span class="text-muted font-13">{{ $item['nisn'] }}</span>
                                        </td>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">Action</h5>
                                            <a href="#keluarkan" class="btn btn-danger font-13"
                                                wire:click="keluarkan('{{ $item['id'] }}')">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1 fw-normal">Nama siswa Belum Ada</h5>
                                            <span class="text-muted font-13">Penggung Jawab</span>
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
