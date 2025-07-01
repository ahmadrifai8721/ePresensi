<?php

namespace App\Http\Livewire;

use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Siswa;
use Livewire\Component;

class TambahSiswa extends Component
{

    public $pageTitle;
    public $kelas;
    public $walikelas = "klik cari untuk menemukan";
    public $daftarKelas;
    public $kelasSelect = "ALL Kelas";
    public $siswa;
    public $totalSiswa = 0;
    public $siswaCari;
    public $siswaDikelas = [];
    public $siswaSelect;

    public function getListeners()
    {
        return [
            "findKelas",
            "findSiswa"
        ];
    }

    public function mount()
    {
        $this->daftarKelas = kelas::all();
        $this->siswaSelect = $this->siswa;
        $this->kelasSelect = $this->kelas->rombongan_belajar_id;
        $this->updateData();
    }

    public function render()
    {
        $this->updateData();
        return view('livewire.tambah-siswa');
    }

    function updateData()
    {

        $siswa = MapingKelas::where("rombongan_belajar_id", $this->kelasSelect)->get();

        $dataSiswa = [];
        foreach ($siswa as $key => $value) {
            $dataSiswa[] = $value->Siswa;
            $this->totalSiswa++;
        }
        $this->siswaDikelas = $dataSiswa;
    }

    function findKelas()
    {
        $siswa = MapingKelas::where("rombongan_belajar_id", $this->kelasSelect)->get();
        $kelas = kelas::where("rombongan_belajar_id", $this->kelasSelect)->get();
        $dataSiswa = [];
        foreach ($siswa as $key => $value) {
            $dataSiswa[] = $value->Siswa;
        }

        foreach ($kelas as $key => $value) {
            # code...
            $this->walikelas = $value->Guru->first()->nama;
        }
        // dump($dataSiswa);
        $this->siswaSelect = $dataSiswa;
    }
    function findSiswa()
    {

        if ($this->siswaCari != " ") {
            # code...
            $siswa = Siswa::Where("name", "LIKE", "%" . $this->siswaCari . "%")
                ->orWhere("nisn", "LIKE", "%" . $this->siswaCari . "%")
                ->get();

            // dump($siswa);

            $this->siswa = $siswa;
        }
    }

    function tambahSiswa(String $peserta_didik_id)
    {

        MapingKelas::create([
            "rombongan_belajar_id" => $this->kelasSelect,
            "peserta_didik_id" => $peserta_didik_id
        ]);
        $this->updateData();
    }

    function salinKelas()
    {
        $this->siswaSelect = $this->siswa;
        $dari = MapingKelas::where([
            "rombongan_belajar_id" => $this->kelasSelect
        ])->get();
        // dump($this->kelas->rombongan_belajar_id);
        // dd($dari);
        foreach ($dari as $key => $value) {
            # code...
            MapingKelas::create([
                "rombongan_belajar_id" => $this->kelas->rombongan_belajar_id,
                "peserta_didik_id" => $value->peserta_didik_id
            ]);
        }
    }


    function keluarkan(String $peserta_didik_id)
    {
        MapingKelas::Where([
            "rombongan_belajar_id" => $this->kelasSelect,
            "peserta_didik_id" => $peserta_didik_id
        ])->delete();
        $this->updateData();
    }
}
