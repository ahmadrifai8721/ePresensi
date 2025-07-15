<?php

namespace App\Http\Livewire;

use App\Models\presensi;
use App\Models\PresensiPKLModel;
use Livewire\Component;



class RekapPKL extends Component
{
    public $date;
    public $presensi = [];

    public function mount()
    {
        $presensi = PresensiPKLModel::where('tanggal', $this->date);
        $this->presensi = $presensi->get();
    }
    public function render()
    {
        return view('livewire.rekap-p-k-l');
    }
    public function findDate()
    {
        $this->date = \Carbon\Carbon::parse($this->date)->format('d/m/Y');
        $presensi = PresensiPKLModel::where('tanggal', $this->date);
        $this->presensi = $presensi->get();
    }
}
