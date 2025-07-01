<div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="cari" id="cari" wire:model='cari' wire:keyup='Cari'>
        <label for="floatingcari">cari users</label>
    </div>

    <div class="d-grid mb-3">
        <span wire:click='createbatch("ptk")' wire:loading.remove class="btn btn-soft-primary rounded-pill">Buat Users
            Untuk Semua
            PTK</span>
        <span wire:loading wire:target='createbatch("ptk")' class="btn btn-soft-warning rounded-pill" type="button"
            disabled>
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Loading...
        </span>
    </div>
    <div class="d-grid mb-3">
        <span wire:click='createbatch("pd")' wire:loading.remove class="btn btn-soft-secondary rounded-pill">Buat Users
            Untuk Semua Peserta
            Didik</span>
        <span wire:loading wire:target='createbatch("pd")' class="btn btn-soft-warning rounded-pill" type="button"
            disabled>
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Loading...
        </span>

    </div>
    <div class="d-grid mb-3">
        <span wire:click='dropAll()' wire:loading.remove class="btn btn-soft-danger rounded-pill">Kosongkan Data
            User</span>
        <span wire:loading wire:target='dropAll' class="btn btn-soft-warning rounded-pill" type="button" disabled>
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Loading...
        </span>
    </div>
    <div class="table-responsive" id="table">
        <table class="table table-centered table-nowrap table-hover mb-0">
            <tbody>
                <td colspan="5">
                    <h5 class="font-14 my-1 fw-normal">Daftar Users</h5>

                </td>
                @forelse ($Users as $item)
                    <tr>
                        @if ($item->ptk_id == null)
                            @if (!$item->Siswa->user_id == null)
                                <td>
                                    <i class="uil uil-check-circle text-info fs-1"></i>
                                    {{-- <small class="text-mute">{{ $item->Siswa->user_id }}</small> --}}
                                </td>
                            @else
                                <td>
                                    <i class="uil uil-times-circle text-danger fs-1"></i>
                                </td>
                            @endif
                        @else
                            @if (!$item->Guru->user_id == null)
                                <td>
                                    <i class="uil uil-check-circle text-info fs-1"></i>
                                    {{-- <small class="text-mute">{{ $item->Guru->user_id }}</small> --}}
                                </td>
                            @else
                                <td>
                                    <i class="uil uil-times-circle text-danger fs-1"></i>
                                </td>
                            @endif
                        @endif
                        <td>
                            <h5 class="font-14 my-1 fw-normal">Nama</h5>
                            <span
                                class="text-muted font-13">{{ $item->ptk_id == null ? $item->Siswa->name : $item->Guru->nama }}</span>
                        </td>
                        <td>
                            <h5 class="font-14 my-1 fw-normal">Peran</h5>
                            <span class="text-muted font-13">{{ $item->peran_id_str }}</span>
                        </td>
                        <td>
                            <h5 class="font-14 my-1 fw-normal">E-Mail</h5>
                            <span class="text-muted font-13">{{ $item->username }}</span>
                        </td>
                        <td>
                            <h5 class="font-14 my-1 fw-normal">Action</h5>
                            <span class="btn btn-success font-13"
                                wire:click="createNew({{ $item->id }})">Create</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <h5 class="font-14 my-1 fw-normal">Users Belum Ada</h5>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
