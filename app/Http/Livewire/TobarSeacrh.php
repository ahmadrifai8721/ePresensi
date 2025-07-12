<?php

namespace App\Http\Livewire;

use App\Models\Guru;
use App\Models\kelas;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use App\Models\tempatPKL;
use Livewire\Component;

class TobarSeacrh extends Component
{
    public $siswa;
    public $guru;
    public $kelas;
    public $pembelajaran;
    public $pkl;
    public $siswaData           = [];
    public $guruData            = [];
    public $kelasData           = [];
    public $pembelajaranData     = [];
    public $pklData     = [];
    public $total;
    public $cari;

    public function mount() {}
    public function render()
    {
        return view('livewire.tobar-seacrh');
    }

    function Cari()
    {
        $siswa = Siswa::Where("name", "LIKE", "%" . $this->cari . "%")
            ->orWhere("nisn", "LIKE", "%" . $this->cari . "%");

        $guru = Guru::Where("nama", "LIKE", "%" . $this->cari . "%");

        $kelas = kelas::Where("kelas", "LIKE", "%" . $this->cari . "%")
            ->orWhere("tingkat", "LIKE", "%" . $this->cari . "%");

        $pembelajaran = Pembelajaran::Where("namaPelajaran", "LIKE", "%" . $this->cari . "%");
        $pkl = tempatPKL::Where("nama", "LIKE", "%" . $this->cari . "%");

        // hitung data yang di temukan
        $this->siswa = $siswa->count();
        $this->guru = $guru->count();
        $this->kelas = $kelas->count();
        $this->pembelajaran = $pembelajaran->count();
        $this->pkl = $pkl->count();
        $this->total = $this->siswa + $this->guru + $this->kelas + $this->pembelajaran + $this->pkl;
        // tampilkan data
        $this->siswaData = $siswa->get();
        $this->guruData = $guru->get();
        $this->kelasData = $kelas->get();
        $this->pembelajaranData = $pembelajaran->get();
        $this->pklData = $pkl->get();
    }
}
