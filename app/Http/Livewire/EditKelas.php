<?php

namespace App\Http\Livewire;

use App\Models\kelas;
use Livewire\Component;

class EditKelas extends Component
{

    public $kelas;
    public $waliKelas;

    public function render()
    {
        return view('livewire.edit-kelas');
    }

    public function update()
    {
        $kelas = kelas::find($this->kelas);

        $kelas->kelas = $this->kelas;
        $kelas->waliKelas = $this->waliKelas;
        $kelas->save();
    }
}
