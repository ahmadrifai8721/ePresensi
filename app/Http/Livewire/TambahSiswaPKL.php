<?php

namespace App\Http\Livewire;

use App\Models\TempatPKL;
use App\Models\MapingPKL;
use App\Models\Siswa;
use Livewire\Component;

class TambahSiswaPKL extends Component
{

    public $pageTitle;
    public $TempatPKL;
    public $waliTempatPKL = "klik cari untuk menemukan";
    public $daftarTempatPKL;
    public $TempatPKLSelect = "ALL TempatPKL";
    public $siswa;
    public $totalSiswa = 0;
    public $siswaCari;
    public $siswaDiTempatPKL = [];
    public $siswaSelect;

    public function getListeners()
    {
        return [
            "findTempatPKL",
            "findSiswa"
        ];
    }

    public function mount()
    {
        $this->daftarTempatPKL = TempatPKL::all();
        $this->siswaSelect = $this->siswa;
        $this->TempatPKLSelect = $this->TempatPKL->id;
        $this->updateData();
    }

    public function render()
    {
        return view('livewire.tambah-siswa-p-k-l');
    }

    function updateData()
    {

        $siswa = MapingPKL::where("tempat_p_k_l_id", $this->TempatPKLSelect)->get();
        $siswapkl = MapingPKL::all();

        $dataSiswa = [];
        foreach ($siswa as $key => $value) {
            $dataSiswa[] = $value->Siswa;
            $this->totalSiswa++;
        }
        $mappedSiswaIds = $siswapkl->pluck('siswa_id')->toArray();
        $this->siswa = Siswa::whereNotIn('id', $mappedSiswaIds)->get();
        $this->siswaDiTempatPKL = $dataSiswa;
    }

    function findTempatPKL()
    {
        $siswa = MapingPKL::where("tempat_p_k_l_id", $this->TempatPKLSelect)->get();
        $TempatPKL = TempatPKL::where("id", $this->TempatPKLSelect)->get();
        $dataSiswa = [];
        foreach ($siswa as $key => $value) {
            $dataSiswa[] = $value->Siswa;
        }

        foreach ($TempatPKL as $key => $value) {
            # code...
            $this->waliTempatPKL = $value->Guru->first()->nama;
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
        $this->updateData();
    }

    function tambahSiswa(String $peserta_didik_id)
    {

        MapingPKL::create([
            "tempat_p_k_l_id" => $this->TempatPKLSelect,
            "siswa_id" => $peserta_didik_id
        ]);
        $this->updateData();
    }

    function salinTempatPKL()
    {
        $this->siswaSelect = $this->siswa;
        $dari = MapingPKL::where([
            "id" => $this->TempatPKLSelect
        ])->get();
        // dump($this->TempatPKL->id);
        // dd($dari);
        foreach ($dari as $key => $value) {
            # code...
            MapingPKL::create([
                "tempat_p_k_l_id" => $this->TempatPKL->id,
                "peserta_didik_id" => $value->peserta_didik_id
            ]);
        }
    }


    function keluarkan(String $peserta_didik_id)
    {
        // dd($peserta_didik_id);
        MapingPKL::Where([
            "tempat_p_k_l_id" => $this->TempatPKLSelect,
            "siswa_id" => $peserta_didik_id
        ])->delete();
        $this->updateData();
    }
}
