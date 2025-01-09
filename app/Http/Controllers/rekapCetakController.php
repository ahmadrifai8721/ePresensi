<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\presensi;
use App\Models\presensiGuru;
use Illuminate\Http\Request;

class rekapCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("admin/rekap/cetak/table", [
            "pageTitle" => "Cetak Rekap",
            "Kelas" => kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kelas $kelas, $pembelajran)
    {
        //
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
        $data =  presensiGuru::find(base64_decode($id));
        return view("admin/rekap/cetak/cari", [
            "pageTitle" => "Cetak Rekap",
            "presensiGuru" => $data,
            "Hadir" => $data->presensiSiswaMapel->where("presensi", "Hadir")->count(),
            // "siswaHadir" => $data->presensiSiswaMapel->where("presensi", "Hadir")->count(),
            "Sakit" => $data->presensiSiswaMapel->where("presensi", "Sakit")->count(),
            "siswaSakit" => $data->presensiSiswaMapel->where("presensi", "Sakit"),
            "Izin" => $data->presensiSiswaMapel->where("presensi", "Izin")->count(),
            "siswaIzin" => $data->presensiSiswaMapel->where("presensi", "Izin"),
            "Alfa" => $data->presensiSiswaMapel->where("presensi", "Alfa")->count(),
            "siswaAlfa" => $data->presensiSiswaMapel->where("presensi", "Alfa"),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data =  presensi::where("kelas_id", base64_decode($id));
        // dd($data->get());
        return view("admin/rekap/cetak/cariKelas", [
            "pageTitle" => "Cetak Rekap Kelas",
            "presensiGuru" => $data->first(),
            "Hadir" => $data->where("presensi", "Hadir")->count(),
            // "siswaHadir" => $data->where("presensi", "Hadir")->count(),
            "Sakit" => $data->where("presensi", "Sakit")->count(),
            "siswaSakit" => $data->where("presensi", "Sakit"),
            "Izin" => $data->where("presensi", "Izin")->count(),
            "siswaIzin" => $data->where("presensi", "Izin"),
            "Alfa" => $data->where("presensi", "Alfa")->count(),
            "siswaAlfa" => $data->where("presensi", "Alfa"),
        ]);
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
