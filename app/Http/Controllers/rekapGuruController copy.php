<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\presensiGuru;
use Illuminate\Http\Request;

class rekapGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        return view("admin/rekap/table", [
            "pageTitle" => "Rekap Guru",
            "totalGuru" => presensiGuru::all()->count(),
            "Guru" => kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return $request->presensi;
    }

    /**
     * Display the specified resource.
     */
    public function show(kelas $guru)
    {
        //
        // $kelas = kelas::find($kelas);
        return view("admin/rekap/show", [
            "pageTitle" => "Rekap Guru Kelas " . $guru->kelas,
            "totalGuru" => $guru->mapingKelas->count(),
            "kelas" => $guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kelas $guru)
    {
        //
        // dump($request->maple_id);
        // return $guru->presensiGuru->where("maple", $request->maple_id)->first()->presensiGuruMapel;

        $maple_id = $request->maple_id;
        if ($maple_id == null) {
            return back()->with("danger", "Mata Pelajaran Tidak Di temukan");
        }
        $getMapel = $guru->presensiGuru->where("maple", $maple_id)->first();

        $data = [
            "pageTitle" => "Edit Rekap Guru Kelas " . $guru->kelas,
            "totalGuru" => $guru->mapingKelas->count(),
            "selectMapel" => $getMapel->pembelajaran->namaPelajaran,
            "dataAbsen" => $getMapel->presensiGuruMapel,
            "maple_id" => $maple_id
        ];
        // return $data;
        return view("admin/rekap/edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, presensiGuru $guru)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presensiGuru $guru)
    {
        //
    }
}
