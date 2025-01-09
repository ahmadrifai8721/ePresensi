<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Guru;
use App\Models\presensiGuru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("admin.guru.guru", ['Guru' => Guru::all()->sortByDesc("id"), "totalGuru" => Guru::count(), "pageTitle" => "Daftar Guru"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.guru.guruCreate", ["kelas" => kelas::all(), "pageTitle" => "Buat Guru Baru"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $ptk_id = env("DAPODIK_SERVER_NPSN") . "-" . rand(0000, 9999);

        $data = $request->input();
        $data["ptk_id"] = $ptk_id;

        // // Tambah Guru Baru
        Guru::create($data);


        return redirect()->back()->with("success", "Data Guru $request->nama Berhasil Di Tambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $Guru)
    {
        //
        $data = [];

        return view("admin.guru.guruShow", [
            'Guru' => $Guru,
            // 'Data' => $data,
            "pageTitle" => "Edit Data Guru $Guru->name"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $Guru)
    {
        return view("admin.guru.guruEdit", ['Guru' => $Guru, "pageTitle" => "Edit Data Guru $Guru->name"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $Guru)
    {
        // return $request->input();
        // return $Guru;
        $Guru->update($request->input());
        return redirect()->back()->with("success", "Data Guru $Guru->nama Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $Guru)
    {
        $namaGuru = $Guru->name;
        $Guru->delete();
        return redirect()->back()->with("success", "Data Guru $namaGuru Berhasil Di hapus");
    }
}
