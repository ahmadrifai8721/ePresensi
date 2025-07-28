<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\presensi;
use App\Models\presensiGuru;
use App\Models\presensiLog;
use App\Models\PresensiPKLModel;
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
            "guruHadir" => presensiGuru::where([
                "presensi" => "Hadir",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "guruTugas" => presensiGuru::where([
                "presensi" => "Tugas",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "guruSakit" => presensiGuru::where([
                "presensi" => "Sakit",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "guruAlfa" => presensiGuru::where([
                "presensi" => "Alfa",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "guruIzin" => presensiGuru::where([
                "presensi" => "Izin",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "presensiGuru" => presensiGuru::where("tanggal", date("d/m/Y")),
            "pklHadir" => PresensiPKLModel::where([
                "presensi" => "Hadir",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "pklTugas" => PresensiPKLModel::where([
                "presensi" => "Tugas",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "pklSakit" => PresensiPKLModel::where([
                "presensi" => "Sakit",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "pklAlfa" => PresensiPKLModel::where([
                "presensi" => "Alfa",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "pklIzin" => PresensiPKLModel::where([
                "presensi" => "Izin",
                "tanggal" => date("d/m/Y")
            ])->count(),
            "presensipkl" => PresensiPKLModel::where("tanggal", date("d/m/Y"))->get(),
        ]);
    }

    private function getPresensiSiswa(String $date, String $Kondisi)
    {
        return presensi::where("tanggal", "LIKE", "%" . $date . "%")->where("presensi", $Kondisi)->count();
    }
}
