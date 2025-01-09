<?php

namespace App\Http\Livewire;

use App\Models\kelas;
use Livewire\Component;

class TambahSiswaBaru extends Component
{

    public $oldkelas;
    public $kelasSelect;
    public $kelas;
    public $oldtingkat;
    public $tingkat;

    public function getListeners()
    {
        return [
            "selectKelas",
        ];
    }

    public function mount()
    {
        $this->tingkat = $this->oldtingkat;
        $this->kelasSelect = $this->oldkelas;
    }

    public function render()
    {
        return view('livewire.tambah-siswa-baru');
    }

    function selectKelas()
    {
        $this->kelas = kelas::Where("tingkat", $this->tingkat)->get();
    }
}
