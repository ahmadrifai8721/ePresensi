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
        return view("admin/rekap/Guru/table", [
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
    public function show(kelas $Guru)
    {
        //
        // return $Guru;
        // $kelas = kelas::find($kelas);
        return view("admin/rekap/Guru/show", [
            "pageTitle" => "Rekap Guru Kelas " . $Guru->kelas,
            "totalGuru" => $Guru->mapingKelas->count(),
            "kelas" => $Guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kelas $Guru)
    {
        //
        // dump($request->maple_id);
        // return $Guru->presensiGuru->where("maple", $request->maple_id)->first()->presensiGuruMapel;

        $maple_id = $request->maple_id;
        if ($maple_id == null) {
            return back()->with("danger", "Mata Pelajaran Tidak Di temukan");
        }
        $getMapel = $Guru->presensiGuru->where("maple", $maple_id)->first();

        $data = [
            "pageTitle" => "Edit Rekap Guru Kelas " . $Guru->kelas,
            "totalGuru" => $Guru->mapingKelas->count(),
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
    public function update(Request $request, presensiGuru $Guru)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presensiGuru $Guru)
    {
        //
        $namaMapel = $Guru->pembelajaran->namaPelajaran;
        $namaGuru = $Guru->Guru->nama;
        $kelas = $Guru->kelas->kelas;
        $tanggal = $Guru->tanggal;
        $Guru->delete();
        return back()->with("success", "Data Absensi $namaMapel Kelas $kelas dengan guru $namaGuru Tanggal $tanggal <strong> Berhasil Di Hapus </strong>");
    }
}
