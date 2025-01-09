<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\presensi;
use App\Models\presensiGuru;
use App\Models\presensiLog;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $datenow = date("d/m/Y");
        $kelasall = kelas::all()->count();
        $presensiGuru = presensiGuru::where("tanggal", $datenow)->get()->groupBy("kelas_id")->count();
        // dd($presensiGuru);
        // dd($datenow);
        return view("admin/dashboard", [
            "pageTitle" => "Dashboard",
            "kelasSudahAbsen" => $presensiGuru,
            "kelasBelumAbsen" => $presensiGuru . " / $kelasall",
            "sakitTotal" => $this->getPresensiSiswa(date("m/Y"), "Sakit"),
            "izinTotal" => $this->getPresensiSiswa(date("m/Y"), "Izin"),
            "alfaTotal" => $this->getPresensiSiswa(date("m/Y"), "Alfa"),
            "hadirTotal" => $this->getPresensiSiswa(date("m/Y"), "Hadir"),
            "sakitHariIni" => $this->getPresensiSiswa(date("d/m/Y"), "Sakit"),
            "izinHariIni" => $this->getPresensiSiswa(date("d/m/Y"), "Izin"),
            "alfaHariIni" => $this->getPresensiSiswa(date("d/m/Y"), "Alfa"),
            "hadirHariIni" => $this->getPresensiSiswa(date("d/m/Y"), "Hadir"),
            "guruHadir" => presensiGuru::where("presensi", "Hadir")->count(),
            "guruTugas" => presensiGuru::where("presensi", "Tugas")->count(),
            "guruSakit" => presensiGuru::where("presensi", "Sakit")->count(),
            "guruAlfa" => presensiGuru::where("presensi", "Alfa")->count(),
            "guruIzin" => presensiGuru::where("presensi", "Izin")->count(),
            "presensiGuru" => presensiGuru::all(),
        ]);
    }

    private function getPresensiSiswa(String $date, String $Kondisi)
    {
        return presensi::where("tanggal", "LIKE", "%" . $date . "%")->where("presensi", $Kondisi)->count();
    }
}
