<div>
    <table class="table table-centered table-nowrap table-hover mb-0" wire:ignore.self>
        <tbody>
            <td colspan="4">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal"
                        wire:model='date' wire:change='findDate'>
                    <label for="tanggal">Tanggal</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="tempat" id="tempat" class="form-select" wire:model='tempatSelect'
                        wire:change='findTempat'>
                        <option value="0">-- Pilih Tempat --</option>
                        @foreach ($tempat as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <label for="tempat">Tempat</label>
                </div>
                <h5 class="font-14 my-1 fw-normal">Jumlah Siswa Yang Absen Hari
                    {{ $date }}:
                    {{ $presensi->count() }}
                </h5>
            </td>
            {{-- @dump($presensi) --}}
            @forelse ($presensi as $item)
                <tr>
                    <td>
                        <h5 class="font-14 my-1 fw-normal">Nama</h5>
                        <span class="text-muted font-13">{{ $item->siswa->name }}</span>
                    </td>
                    <td>
                        <h5 class="font-14 my-1 fw-normal">Bukti</h5>
                        <!-- Image thumbnail -->
                        <img src="{{ asset('storage/buktiPresensiPKL') . '/' . $item->bukti }}" alt=""
                            width="100" style="cursor: zoom-in" data-bs-toggle="modal"
                            data-bs-target="#zoomModal{{ $item->id }}" />

                        <!-- Modal for zoomed image -->
                        <div class="modal fade" id="zoomModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="zoomModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0">
                                    <div class="modal-body text-center p-0">
                                        <img src="{{ asset('storage/buktiPresensiPKL') . '/' . $item->bukti }}"
                                            alt="" class="img-fluid rounded" style="max-height:80vh;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5 class="font-14 my-1 fw-normal">Presensi</h5>

                        <form action="{{ route('PKL.update', $item->id) }}" method="post" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <select class="form-select mt-3 mx-2" id="Presensi" name="presensi">
                                <option {{ $item->presensi == 'Hadir' ? 'selected' : '' }}>Hadir
                                </option>
                                <option {{ $item->presensi == 'Sakit' ? 'selected' : '' }}>Sakit
                                </option>
                                <option {{ $item->presensi == 'Izin' ? 'selected' : '' }}>Izin
                                </option>
                                <option {{ $item->presensi == 'Alfa' ? 'selected' : '' }}>Alfa
                                </option>
                            </select>
                            <button type="submit" class="fw-bold font-13 btn btn-soft-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('PKL.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="fw-bold font-13 btn btn-soft-danger">Hapus
                                Absensi</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <h5 class="font-14 my-1 fw-bold text-center text-uppercase text-danger">
                            Belum Ada Data</h5>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table> {{-- In work, do what you enjoy. --}}

</div>
