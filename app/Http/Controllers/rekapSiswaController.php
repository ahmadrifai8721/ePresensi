<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\presensi;
use App\Models\presensiGuru;
use App\Models\presensiSiswaMapel;
use Illuminate\Http\Request;

class rekapSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        return view("admin/rekap/Siswa/table", [
            "pageTitle" => "Rekap Siswa",
            "totalSiswa" => presensi::all()->count(),
            "siswa" => kelas::all()
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
        foreach ($request->presensi as $key => $value) {
            presensiSiswaMapel::find($key)->update([
                "presensi" => $value
            ]);
        }
        return redirect()->route("rekapSiswa.index")->with("success", "Data Absensi Berhasil Di Ubah");
    }

    /**
     * Display the specified resource.
     */
    public function show(kelas $Siswa)
    {
        //
        // $kelas = kelas::find($kelas);
        return view("admin/rekap/Siswa/show", [
            "pageTitle" => "Rekap Siswa Kelas " . $Siswa->kelas,
            "totalSiswa" => $Siswa->mapingKelas->count(),
            "kelas" => $Siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kelas $Siswa)
    {
        //
        // dump($request->maple_id);
        // return $Siswa->presensiGuru->where("maple", $request->maple_id)->first()->presensiSiswaMapel;

        $maple_id = $request->maple_id;
        if ($maple_id == null) {
            return back()->with("danger", "Mata Pelajaran Tidak Di temukan");
        }
        $getMapel = $Siswa->presensiGuru->where("maple", $maple_id)->first();

        $data = [
            "pageTitle" => "Edit Rekap Siswa Kelas " . $Siswa->kelas,
            "totalSiswa" => $Siswa->mapingKelas->count(),
            "selectMapel" => $getMapel->pembelajaran->namaPelajaran,
            "dataAbsen" => $getMapel->presensiSiswaMapel,
            "maple_id" => $maple_id
        ];
        // return $data;
        return view("admin/rekap/Siswa/edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, presensi $Siswa)
    {
        //
        $Siswa = presensi::where("id", $request->id)->update([
            "presensi" => $request->presensi
        ]);
        return back()->with("success", "Data Absensi <br> <strong> Berhasil Di Update </strong>");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presensi $Siswa)
    {
        //
        // return $Siswa;
        $nama = $Siswa->User->name;
        $kelas = $Siswa->Kelas->kelas;
        $tanggal = $Siswa->tanggal;
        $Siswa->delete();
        return back()->with("success", "Data Absensi $nama Kelas $kelas Tanggal $tanggal <br> <strong> Berhasil Di Hapus </strong>");
    }

    public function kelas(kelas $kelas)
    {
        return view("admin/rekap/siswa/showkelas", [
            "pageTitle" => "Rekap Siswa Kelas " . $kelas->kelas,
            "totalSiswa" => $kelas->PresensiSiswa->count(),
            "kelas" => $kelas->PresensiSiswa,
            "kelasName" => $kelas->kelas,
        ]);
    }
}
