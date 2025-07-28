<?php

namespace App\Http\Livewire;

use App\Models\presensi;
use App\Models\PresensiPKLModel;
use App\Models\tempatPKL;
use Livewire\Component;



class RekapPKL extends Component
{
    public $date;
    public $dateSelect;
    public $tempatSelect;
    public $tempat;
    public $check;
    public $presensis;

    public function mount()
    {
        $presensi = PresensiPKLModel::where('tanggal', $this->date);
        $this->presensis = $presensi->get();
        $this->tempat = tempatPKL::all();
        $this->dateSelect = $this->date;
    }
    public function findDate()
    {
        // dd(is_array(explode('/', $this->date)));
        //     dd($this->tempatSelect);
        $this->dateSelect = \Carbon\Carbon::parse($this->dateSelect)->format('d/m/Y');
        if ($this->tempatSelect > 0) {
            # code...
            $presensi = PresensiPKLModel::where([
                'tempat_p_k_l_id' => $this->tempatSelect,
                'tanggal' => $this->dateSelect
            ]);
            $this->presensis = $presensi->get();
        } else {
            $presensi = PresensiPKLModel::where(
                'tanggal',
                $this->dateSelect
            );
            $this->presensis = $presensi->get();
            // dd($presensi->get());
        }
    }
    public function findTempat()
    {
        // dd(is_array(explode('/', $this->dateSelect)));
        // dd($this->tempatSelect);
        if (!is_array(explode('/', $this->dateSelect))) {
            # code...
            $this->dateSelect = \Carbon\Carbon::parse($this->dateSelect)->format('d/m/Y');
        }
        if ($this->tempatSelect > 0) {
            # code...
            $presensi = PresensiPKLModel::where([
                'tempat_p_k_l_id' => $this->tempatSelect,
                'tanggal' => $this->dateSelect
            ]);
            $this->presensis = $presensi->get();
        } else {
            $presensi = PresensiPKLModel::where([
                'tanggal' => $this->dateSelect
            ]);
            $this->presensis = $presensi->get();
        }
    }
    public function updating($view, $data)
    {
        $this->check = true;
        // dump($this->dateSelect);
        // Runs BEFORE the provided view is rendered...
        //
        // $view: The view about to be rendered
        // $data: The data provided to the view
    }
    public function updated($view, $data)
    {
        $this->check = false;
        // dump($this->dateSelect);
        // $this->presensis =  $presensi = PresensiPKLModel::where([
        //     'tempat_p_k_l_id' => $this->tempatSelect,
        //     'tanggal' => $this->dateSelect
        // ]);
        // Runs BEFORE the provided view is rendered...
        //
        // $view: The view about to be rendered
        // $data: The data provided to the view
    }
    public function render()
    {
        return view('livewire.rekap-p-k-l');
    }
}
