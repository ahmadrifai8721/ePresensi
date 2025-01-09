<?php

namespace App\Http\Livewire;

use App\Models\Guru;
use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Pembelajaran;
use Livewire\Component;

class Presensi extends Component
{
    public $dataKelas;
    public $dataSiswa = [];
    public $dataMapel = [];
    public $kelas;
    public $namaGuruMapel;
    public $namaGuruMapel_ptk_id;
    public $pembelajaran_id;
    public $Walikelas;
    public $tugas = false;
    public $presensiGuru;

    public function mount()
    {
        $this->dataKelas = kelas::all();
    }

    public function render()
    {
        return view('livewire.presensi');
    }

    public function findWaliKelas()
    {
        if ($this->kelas == "all") {
            $this->dataSiswa = [];
            $this->Walikelas = "";
            $this->dataMapel = [];
            return;
        }
        $findData = MapingKelas::where('rombongan_belajar_id', $this->kelas);
        $findDataSiswa = $findData->get();
        $findWalikelas = $findData->first()->Kelas->Guru->nama;
        $findmapel = $findData->first()->Kelas->first()->Pembelajaran;
        // dd($findWalikelas);

        $this->dataSiswa = $findDataSiswa;
        $this->Walikelas = $findWalikelas;
        $this->dataMapel = $findmapel;
    }
    public function tugasCheck()
    {
        if ($this->presensiGuru == "Tugas") {
            # code...
            $this->tugas = true;
        } else {
            $this->tugas = false;
        }
    }
    public function guruMapelCheck()
    {
        // dd(Pembelajaran::where("pembelajaran_id", $this->pembelajaran_id)->first());
        $this->namaGuruMapel = Pembelajaran::where("pembelajaran_id", $this->pembelajaran_id)->first()->guru->nama;
        $this->namaGuruMapel_ptk_id = Pembelajaran::where("pembelajaran_id", $this->pembelajaran_id)->first()->guru->ptk_id;
    }
}
