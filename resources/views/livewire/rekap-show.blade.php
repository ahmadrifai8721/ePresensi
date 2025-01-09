<div>
    <table class="table table-centered table-nowrap table-hover mb-0">
        <tbody>
            <td>
                <h5 class="font-14 my-1 fw-normal">Jumlah Siswa Yang Absen Hari Ini: {{ $totalSiswa
                    }}</h5>
                <h5 class="font-14 my-1 fw-normal">Mata Pelajaran: {{ $selectMapelName}}</h5>
            </td>
            <td>
                <form action="{{ route('rekapSiswa.edit', $kelas->kelas) }}" method="POST" class="d-flex">
                    <select id="selectView" class="mx-2 form-control select2" style="max-width: 390px"
                        wire:model='selectMapel' wire:change='lihatPerMaple()'>
                        <option selected value="ALL">Pilih Mata Pelajaran</option>
                        @forelse ($kelas->presensiGuru as $result)
                        <option value="{{$result->pembelajaran->pembelajaran_id}}">
                            {{$result->pembelajaran->namaPelajaran}}</option>
                        @empty
                        <option>Belum Absen</option>

                        @endforelse
                    </select>
                    @csrf
                    @method("GET")
                    <input type="hidden" name="maple_id" wire:model='selectMapelID' value="{{ $selectMapelID }}">
                    <button type="submit" class="mx-2 btn btn-soft-warning right {{ $edit? '':'d-none' }}">Edit Data
                        Absensi</button>
                </form>
            </td>
            <tr wire:loading>
                <td colspan="2">
                    <h5 class="font-14 my-1 fw-bold text-center text-uppercase text-warning">Memuat Data</h5>
                </td>
            </tr>
            @forelse ($dataAbsen as $item)
            <tr wire:loading.remove>
                @if ($item->siswa)
                <td>
                    <h5 class="font-14 my-1 fw-normal">Nama</h5>
                    <span class="text-muted font-13">{{ $item->siswa->name }}</span>
                </td>
                <td>
                    <h5 class="font-14 my-1 fw-normal">Presensi</h5>
                    @forelse ($item->siswa->presensiMapel as $presensi)
                    <span class="fw-normal font-13">
                        {{ $presensi->presensiGuru->pembelajaran->namaPelajaran}}
                        (
                        {{$presensi->presensiGuru->Guru->nama}}
                        )
                        <presensi class=" fw-bold"> : {{ $presensi->presensi }}</presensi>
                    </span>
                    <br>
                    @empty
                    <span class="fw-bold font-13">Belum Absen</span>
                    @endforelse
                </td>
                @else
                <td>
                    <h5 class="font-14 my-1 fw-normal">Nama</h5>
                    <span class="text-muted font-13">{{ $item->User->name }}</span>
                </td>
                <td>
                    <h5 class="font-14 my-1 fw-normal">Presensi</h5>

                    <span class="fw-normal font-13">
                        {{ $item->presensi }}
                    </span>
                </td>

                @endif
            </tr>
            @empty
            <tr>
                <td colspan="2">
                    <h5 class="font-14 my-1 fw-bold text-center text-uppercase text-danger">Belum Ada Data</h5>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table> {{-- In work, do what you enjoy. --}}
</div>
