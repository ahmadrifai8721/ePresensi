<?php

namespace App\Http\Livewire;

use App\Models\Pembelajaran;
use App\Models\presensiGuru;
use Livewire\Component;

class RekapShow extends Component
{

    public $totalSiswa;
    public $kelas;
    public $siswaCount;
    public $dataAbsen;
    public $edit = false;
    public $selectMapel = "ALL";
    public $selectMapelName = "ALL";
    public $selectMapelID = null;

    public function mount()
    {
        $this->dataAbsen = $this->kelas->MapingKelas;
        // dd($this->dataAbsen);
    }

    public function render()
    {
        // dd($this->mapel);
        return view('livewire.rekap-show');
    }


    public function lihatPerMaple()
    {

        $this->selectMapelID = $this->selectMapel;
        $getPembelajaran = Pembelajaran::where("pembelajaran_id", $this->selectMapel)->first();
        $getPresensiMapel = $this->kelas->presensiGuru->where("maple", $this->selectMapel)->first();
        if ($getPresensiMapel) {
            $this->selectMapelName = $getPembelajaran->namaPelajaran;
            # code...
            // dd($getPresensiMapel->presensiSiswaMapel);
            $this->dataAbsen = $getPresensiMapel->presensiSiswaMapel;
            $this->edit = true;
        } else {
            $this->dataAbsen = $this->kelas->MapingKelas;
            $this->edit = false;
        }
    }
}
