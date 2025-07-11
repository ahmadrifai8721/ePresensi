<?php

namespace App\Http\Livewire;

use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\MapingPKL;
use App\Models\Pembelajaran;
use App\Models\PresensiPKLModel;
use App\Models\tempatPKL;
use Livewire\Component;

class PresensiPKL extends Component
{

    public $dataSiswa = [];
    public $namaPJ;
    public $tempatPKL = [];
    public $tempatPKLselect;
    public $siswa_id;
    public $siswa_id_check;
    public $presensi;
    public $sudahAbsen = false;

    public function mount()
    {
        $this->tempatPKL = tempatPKL::all();
    }

    public function render()
    {
        return view('livewire.presensi-p-k-l');
    }

    public function PJCheck()
    {
        if ($this->tempatPKLselect == "null") {
            $this->namaPJ = "Pilih Tempat PKL";
            $this->dataSiswa = [];
            return;
        } else {

            // dd(tempatPKL::find($this->tempatPKLselect)->penanggungJawab->nama);
            $this->namaPJ = tempatPKL::find($this->tempatPKLselect)->penanggungJawab->nama;
            $this->dataSiswa = MapingPKL::where('tempat_p_k_l_id', $this->tempatPKLselect)->get()->map(function ($item) {
                return $item->Siswa;
            })->toArray();
            // dd($this->dataSiswa);
        }
    }

    public function siswaCheck()
    {

        // dump($this->sudahAbsen = PresensiPKLModel::where(['siswa_id' => $this->siswa_id, 'tempat_p_k_l_id' => $this->tempatPKLselect])->exists());
        if ($this->sudahAbsen = PresensiPKLModel::where(['siswa_id' => $this->siswa_id, 'tempat_p_k_l_id' => $this->tempatPKLselect])->exists()) {
            # code...
            $this->siswa_id_check = false;
            $this->sudahAbsen = true;
        } else {
            $this->siswa_id_check = true;
            $this->sudahAbsen = false;
        }
    }
}
