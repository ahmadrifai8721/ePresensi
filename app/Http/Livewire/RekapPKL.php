<?php

namespace App\Http\Livewire;

use App\Models\presensi;
use App\Models\PresensiPKLModel;
use App\Models\tempatPKL;
use Livewire\Component;



class RekapPKL extends Component
{
    public $date;
    public $tempatSelect;
    public $tempat;
    public $presensis = [];

    public function mount()
    {
        $presensi = PresensiPKLModel::where('tanggal', $this->date);
        $this->presensis = $presensi->get();
        $this->tempat = tempatPKL::all();
    }
    public function render()
    {
        return view('livewire.rekap-p-k-l');
    }
    public function findDate()
    {
        $this->date = \Carbon\Carbon::parse($this->date)->format('d/m/Y');
        $presensi = PresensiPKLModel::where('tanggal', $this->date);
        $this->presensis = $presensi->get();
        $this->tempatSelect = 0;
    }
    public function findTempat()
    {
        // dd(is_array(explode('/', $this->date)));
        // dd($this->tempatSelect);
        if (!is_array(explode('/', $this->date))) {
            # code...
            $this->date = \Carbon\Carbon::parse($this->date)->format('d/m/Y');
        }
        if ($this->tempatSelect > 0) {
            # code...
            $presensi = PresensiPKLModel::where([
                'tempat_p_k_l_id' => $this->tempatSelect,
                'tanggal' => $this->date
            ]);
            $this->presensis = $presensi->get();
        } else {
            $presensi = PresensiPKLModel::where([
                'tanggal' => $this->date
            ]);
            $this->presensis = $presensi->get();
        }
    }
}
