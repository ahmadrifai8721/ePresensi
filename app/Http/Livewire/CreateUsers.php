<?php

namespace App\Http\Livewire;

use App\Models\Dapo_Pengguna;
use App\Models\Guru;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\User;
use App\Models\UserRole;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateUsers extends Component
{
    public $Users;
    public $cari;
    public $success;
    public $warning;


    public function mount()
    {
        $this->Users = Dapo_Pengguna::all();
    }

    public function render()
    {
        return view('livewire.create-users');
    }

    public function createNew(Dapo_Pengguna $Dapo_Pengguna)
    {

        if ($Dapo_Pengguna->peserta_didik_id) {

            $cariUser = Siswa::where("peserta_didik_id", $Dapo_Pengguna->peserta_didik_id);
            $nama = $cariUser->get()->first()->name;
            $create_user = User::updateOrCreate([
                "name" => $nama,
                "email" => $cariUser->get()->first()->nisn . "@" . env("DAPODIK_SERVER_NPSN") . ".sch.id",
                "password" => $cariUser->get()->first()->nisn,
            ]);

            $cariUser->update([
                "user_id" => $create_user->id
            ]);

            $role = Role::where("role", $Dapo_Pengguna->peran_id_str)->get()->first()->id;

            UserRole::create([
                "user_id" => $create_user->id,
                "role_id" => $role
            ]);

            $this->dispatchBrowserEvent(
                'swal',
                [
                    "title" => "User Untuk $nama Telah Dibuat",
                    "icon" => "success",
                    "timer" => 3000,
                    "animation" => true,
                    "toast" => true,
                    "position" => 'top-end',
                    "showConfirmButton" => false,
                ]
            );
            $this->cari = "";
            $this->Users = Dapo_Pengguna::all();
        } else {

            $cariUser = Guru::where("ptk_id", $Dapo_Pengguna->ptk_id);
            $nama = $cariUser->get()->first()->nama;
            $create_user = User::updateOrCreate([
                "name" => $nama,
                "email" => $Dapo_Pengguna->username,
                "password" => $Dapo_Pengguna->password,
            ]);

            $cariUser->update([
                "user_id" => $create_user->id
            ]);

            $role = Role::where("role", $Dapo_Pengguna->peran_id_str)->get()->first()->id;

            UserRole::create([
                "user_id" => $create_user->id,
                "role_id" => $role
            ]);

            $this->dispatchBrowserEvent('swal', [
                "title" => "User Untuk $nama Telah Dibuat dengan Password sama dengan DAPODIK",
                "icon" => "success",
                "timer" => 3000,
                "animation" => true,
                "toast" => true,
                "position" => 'top-end',
                "showConfirmButton" => false,
            ]);
            $this->cari = "";
            $this->Users = Dapo_Pengguna::all();
        }
    }

    public function createbatch(String $type)
    {


        if ($type == "ptk") {

            $dataPengguna = Dapo_Pengguna::Where("peran_id_str", "PTK")->get();
            // dd($dataPengguna);
            $i = 0;
            foreach ($dataPengguna as $key => $value) {
                $create_user = User::updateOrCreate([
                    "name" => $value->Guru->nama,
                    "dapo_id" => $value->ptk_id,
                    "email" => $value->username,
                    "password" => $value->password,
                ]);

                Guru::where("ptk_id", $value->ptk_id)->update([
                    "user_id" => $create_user->id
                ]);

                $role = Role::where("role", "PTK")->get()->first()->id;

                UserRole::create([
                    "user_id" => $create_user->id,
                    "role_id" => $role
                ]);
                $this->dispatchBrowserEvent('swal', [
                    "title" => "User Untuk " . $value->Guru->nama . " Telah Dibuat",
                    "icon" => "success",
                    "timer" => 3000,
                    "animation" => true,
                    "toast" => true,
                    "position" => 'top-end',
                    "showConfirmButton" => false,
                ]);
                $i++;
            }
            $this->dispatchBrowserEvent('swal', [
                "title" => "$i User Untuk PTK Telah Dibuat",
                "icon" => "success",
                "timer" => 3000,
                "animation" => true,
                "toast" => true,
                "position" => 'top-end',
                "showConfirmButton" => false,
            ]);
            $this->cari = "";
            $this->Users = Dapo_Pengguna::all();
        }


        if ($type == "pd") {


            $dataPengguna = Siswa::all();
            // dd($dataPengguna);
            $i = 0;
            foreach ($dataPengguna as $key => $value) {
                $create_user = User::updateOrCreate([
                    "email" => $value->nisn . "@" . env("DAPODIK_SERVER_NPSN") . ".epr",
                ], [
                    "name" => $value->name,
                    "dapo_id" => $value->peserta_didik_id,
                    "email" => $value->nisn . "@" . env("DAPODIK_SERVER_NPSN") . ".epr",
                    "password" => bcrypt($value->nisn),
                ]);

                Siswa::where("peserta_didik_id", $value->peserta_didik_id)->update([
                    "user_id" => $create_user->id
                ]);

                $role = Role::where("role", "Peserta Didik")->get()->first()->id;

                UserRole::create([
                    "user_id" => $create_user->id,
                    "role_id" => $role
                ]);
                // $this->success = "User Untuk " . $value->Siswa->name . " Telah Dibuat";
                $i++;
            }
            $this->dispatchBrowserEvent('swal', [
                "title" => "$i User Untuk Peserta Didik Telah Dibuat",
                "icon" => "success",
                "timer" => 3000,
                "animation" => true,
                "toast" => true,
                "position" => 'top-end',
                "showConfirmButton" => false,
            ]);
            $this->cari = "";
            $this->Users = Dapo_Pengguna::all();
        }
    }

    public function Cari()
    {
        $data = [];

        $data = Dapo_Pengguna::where("username", "LIKE", "%" . $this->cari . "%")
            ->orWhere("peran_id_str", "LIKE", "%" . $this->cari . "%")
            ->get();

        $this->Users = $data == null ? Dapo_Pengguna::all() : $data;

        // dump($data);
    }

    public function dropAll()
    {


        UserRole::whereNot("user_id",  Auth::user()->id)->delete();

        Siswa::whereNot("user_id", Auth::user()->id)->update([
            "user_id" => null
        ]);
        Guru::whereNot("user_id", Auth::user()->id)->update([
            "user_id" => null
        ]);
        User::whereNot("id", Auth::user()->id)->delete();

        $this->dispatchBrowserEvent('swal', [
            "title" => "Data User Berhasil Di Kosongkan",
            "icon" => "success",
            "timer" => 3000,
            "animation" => true,
            "toast" => true,
            "position" => 'top-end',
            "showConfirmButton" => false,
        ]);
        $this->Users = Dapo_Pengguna::all();
    }
}
