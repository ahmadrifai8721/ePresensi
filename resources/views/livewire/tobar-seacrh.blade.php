<div>
    <!-- Topbar Search Form -->
    <div class="app-search dropdown d-none d-lg-block">
        <form>
            <div class="input-group">
                <input type="search" class="form-control dropdown-toggle" placeholder="Search..." id="top-search"
                    wire:model="cari" wire:keyup='Cari'>
                <span class="mdi mdi-magnify search-icon"></span>
                {{-- <button class="input-group-text btn btn-primary" type="button">Search</button> --}}
            </div>
        </form>

        <div class="dropdown-menu dropdown-menu-animated dropdown-xxl" style="overflow: scroll; max-height: 650px;"
            id="search-dropdown" wire:ignore.self>

            @if ($total >= 1)
            <!-- Total-->
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow mb-2">Ditemukan <span class="text-danger">{{ $total }}</span> data</h5>
            </div>
            @endif
            @if ($siswa)

            <!-- Siswa-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">{{ $siswa }} Siswa Di Temukan</h6>
            </div>
            @forelse ($siswaData as $item)
            <a href="{{ route('siswa.show',$item->id) }}" class="dropdown-item notify-item">
                <i class="uil uil-graduation-hat font-16 me-1"></i>
                <span>{{ $item->name }} ({{ $item->nisn }})</span>
            </a>

            @empty
            @endforelse
            @endif

            @if ($guru)


            <!-- Guru-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">{{ $guru }} Guru Di Temukan</h6>
            </div>
            @forelse ($guruData as $item)
            <a href="{{ route('guru.show',$item->id) }}" class="dropdown-item notify-item">
                <i class="uil uil-graduation-hat font-16 me-1"></i>
                <span>{{ $item->nama }}</span>
            </a>

            @empty
            @endforelse
            @endif
            @if ($kelas)


            <!-- Kelas-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">{{ $kelas }} Kelas Di Temukan</h6>
            </div>
            @forelse ($kelasData as $item)
            <a href="{{ route('kelas.show',$item->kelas) }}" class="dropdown-item notify-item">
                <i class="mdi mdi-google-classroom font-16 me-1"></i>
                <span>{{ $item->tingkat }} ( {{ $item->kelas }} )</span>
            </a>

            @empty
            @endforelse
            @endif
            @if ($pembelajaran)

            <!-- pembelajran-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">{{ $pembelajaran }} Pembelajaran Di Temukan</h6>
            </div>
            @forelse ($pembelajaranData as $item)
            <a href="{{ route('pembelajaran.show',$item->id) }}" class="dropdown-item notify-item">
                <i class="mdi mdi-google-classroom font-16 me-1"></i>
                <span>
                    {{ $item->namaPelajaran }} <br>
                    {{ $item->kelas()->first() == null? "Kelas Telah di hapus" :
                    $item->kelas()->first()->kelas }}<br>
                    {{ $item->guru->nama }}
                </span>
            </a>

            @empty
            @endforelse
            @endif

        </div>
    </div>
</div>
