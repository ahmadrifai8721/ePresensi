<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\kelas;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class pembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.pembelajaran.pembelajaran", ['pembelajaran' => Pembelajaran::all()->sortByDesc("id"), "pageTitle" => "Daftar Pembelajaran"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.Pembelajaran.PembelajaranCreate", ["kelas" => kelas::all(), "guru" => Guru::all(), "pageTitle" => "Buat Pembelajaran Baru"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $pembelajaran_id = env("DAPODIK_SERVER_NPSN") . "-" . rand(0000, 9999);

        $data = $request->input();
        $data["pembelajaran_id"] = $pembelajaran_id;

        // // Tambah Pembelajran Baru
        // return $data;

        Pembelajaran::create($data);

        return redirect()->back()->with("success", "Data Pembelajaran $request->namaPelajran Berhasil Di Tambahkan");
    }


    /**
     * Display the specified resource.
     */
    public function show(Pembelajaran $pembelajaran)
    {
        //
        $kelas = $pembelajaran->kelas == null ? "Kelas Telah di hapus " : $pembelajaran->kelas->kelas;
        return view("admin.pembelajaran.pembelajaranShow", ['pembelajaran' => $pembelajaran, "pageTitle" => "Edit Data pembelajaran $pembelajaran->name Kelas $kelas"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelajaran $pembelajaran)
    {
        //
        $kelas = $pembelajaran->kelas == null ? "Kelas Telah di hapus " : $pembelajaran->kelas->kelas;
        return view("admin.pembelajaran.pembelajaranEdit", ['pembelajaran' => $pembelajaran, "kelas" => kelas::all(), "guru" => Guru::all(), "pageTitle" => "Edit Data Pembelajaran $pembelajaran->namaPembelajaran Kelas $kelas"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelajaran $pembelajaran)
    {
        //
        // return $request->input();
        $pembelajaran->update($request->input());
        return redirect()->back()->with("success", "Data pembelajaran $pembelajaran->namaPelajaran Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelajaran $pembelajaran)
    {
        //
        $namaPelajran = $pembelajaran->namaPelajaran;
        $pembelajaran->delete();
        return redirect()->back()->with("success", "Data Pembelajaran $namaPelajran Berhasil Di hapus");
    }
}
