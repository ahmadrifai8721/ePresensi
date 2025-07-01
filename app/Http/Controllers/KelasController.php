<?php

namespace App\Http\Controllers;

use App\Models\Dapo_Jurusan;
use App\Models\Guru;
use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("admin.kelas.kelas", ['kelas' => kelas::all()->sortByDesc("kelas", SORT_NUMERIC), "pageTitle" => "Daftar Kelas"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.kelas.kelasCreate", ["gurus" => Guru::all(), "jurusans" => Dapo_Jurusan::all(), "pageTitle" => "Buat Kelas Baru Kelass"]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request->input();
        MapingKelas::Where([
            "rombongan_belajar_id" => $request->kelas_id,
            "peserta_didik_id" => $request->pd_id
        ])->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(kelas $kela)
    {

        $mapingKelas = $kela->mapingKelas()->get();
        $siswa = [];
        foreach ($mapingKelas as $key => $value) {
            # code...
            $siswa[] = $value->siswa()->first();
        }
        // return $kela->mapingKelas;

        return view("admin.kelas.kelasShow", ['Siswa' => $siswa, "kelas_id" => $kela->kelas, "pageTitle" => "Daftar Diswa Kelas $kela->kelas"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kelas $kela)
    {
        return view("admin.kelas.kelasEdit", ['kelas' => $kela, "gurus" => Guru::all(), "pageTitle" => "Edit Kelas $kela->kelas"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kelas $kela)
    {
        $kela->update($request->input());
        return redirect()->route("kelas.index")->with("success", "Data Kelas $kela->kelas Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kelas $kela)
    {

        MapingKelas::Where([
            "rombongan_belajar_id" => $kela->rombongan_belajar_id
        ])->delete();

        Pembelajaran::Where([
            "kelas_id" => $kela->id
        ])->delete();

        $kela->delete();
        return redirect()->back();
    }

    private function findKelas(String $kelas)
    {
        return kelas::find($kelas);
    }
}
