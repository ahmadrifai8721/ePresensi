<?php

namespace App\Http\Livewire;

use App\Models\kelas;
use Livewire\Component;

class RekapCetak extends Component
{

    public $dataKelas;
    public $dataPresensi = [];
    public $tanggal;


    public function mount()
    {
        $this->tanggal = Date("m/d/Y");
    }

    protected $listeners = [
        'setdataPresensi'
    ];

    public function render()
    {
        return view('livewire.rekap-cetak');
    }

    public function cari($kelas)
    {

        $cariDataMapel = $this->dataKelas->presensiGuru->where("tanggal", $this->tanggal);
        dd([$cariDataMapel, $this->tanggal, $kelas]);
        $result = [
            "namaMapel" => "",
            "absensiGuru" => 0,
            "totalAbsensiSiswa" => 0,
            "totalAbsensiSiswaMapel" => 0,
        ];
        $this->dataPresensi = $result;
    }
    public function setdataPresensi($data)
    {
        // dump($data["Mapel"]);
        if ($data == null) {
            # code...
            $this->dataPresensi = [];
        } else {
            # code...
            $this->dataPresensi = $data["Mapel"];
        }
    }
}
