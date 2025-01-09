<?php

namespace App\Http\Controllers;

use App\Models\Dapo_PD;
use App\Models\Dapo_Rombel;
use App\Models\Guru;
use App\Models\kelas;
use Illuminate\Http\Request;

class Dapo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.dapodik.index", [
            "pageTitle" => "Dapodik Import",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $rombelDapodik = Dapo_Rombel::all();
        // $totalData = $rombelDapodik->count();
        // kelas::truncate();
        // // return;
        // foreach ($rombelDapodik as $key => $value) {
        //     // dump([
        //     //     "kelas" => $value->nama,
        //     //     "rombongan_belajar_id" => $value->rombongan_belajar_id,
        //     //     "walikelas" => Guru::where("ptk_id", $value->ptk_id)->first()->id,
        //     //     "tingkat" => $value->tingkat_pendidikan_id_str,
        //     //     "jurusan" => $value->jurusan_id_str,
        //     // ]);
        //     $upload = kelas::firstOrNew([
        //         "kelas" => $value->nama,
        //         "rombongan_belajar_id" => $value->rombongan_belajar_id,
        //         "waliKelas" => Guru::where("ptk_id", $value->ptk_id)->first()->id,
        //         "tingkat" => $value->tingkat_pendidikan_id_str,
        //         "jurusan" => $value->jurusan_id_str,
        //     ]);
        //     $upload->save();
        //     foreach (Dapo_PD::where("rombongan_belajar_id", $value->rombongan_belajar_id)->get() as $key => $value) {
        //         # code...
        //         $value->Siswa()->update(["kelas_id" => kelas::where("rombongan_belajar_id", $value->rombongan_belajar_id)->first()->id]);
        //     }
        // }
        // return;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
