<?php

namespace App\Http\Livewire;

use App\Models\Dapo_Sekolah;
use App\Models\Setting;
use App\Models\UserRole;
use Livewire\Component;

class GetSchoolDapodik extends Component
{
    public $dataSekolah;
    public $userAdmin;
    public $presensi = false;

    public $change = false;
    public $changeText = false;

    public function getListeners()
    {
        return [
            'setPresensi'
        ];
    }

    public function mount()
    {
        $this->dataSekolah = Setting::first();
        $this->userAdmin = UserRole::where("role_id", 1)->first()->User;

        $this->presensi = $this->dataSekolah->presensiStatus;
    }

    public function render()
    {
        return view('livewire.get-school-dapodik');
    }

    public function setPresensi()
    {
        Setting::where("id", 1)->update([
            "presensiStatus" => $this->presensi
        ]);
        return redirect()->route("setting.index")->with('success', 'Presensi Status successfully updated.');;
    }
}
