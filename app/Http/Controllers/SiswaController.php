<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("admin.siswa.siswa", ['siswa' => Siswa::all()->sortByDesc("id"), "totalSiswa" => Siswa::count(), "pageTitle" => "Daftar Siswa"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.siswa.siswaCreate", ["kelas" => kelas::all(), "pageTitle" => "Buat Siswa Baru"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $validatedData = $request->validate([
            'name'  => 'required',
            'nisn'  => 'required|unique:siswas,nisn',
            'jk'    => 'required',
            'Tingkat' => 'required',
            'kelas' => 'required',
        ], [
            'name.required'     => "Nama Lengkap belum di isi",
            'nisn.unique'       => "NISN Sudah Digunakan Oleh Siswa Lain",
            'nisn.required'     => "NISN belum di isi",
            'jk.required'       => "Jenis Kelamin belum di isi",
            'Tingkat.required'    => "Tingkat belum di isi",
            'kelas.required'    => "Kelas belum di isi",
        ]);
        if ($validatedData) {
            # code...
            if (($request->kelas == "Pilih Kelas") or ($request->kelas == null)) {
                # code...
                return redirect()->back()->withErrors("Kelas Belum Di pilih");
            }
            $peserta_didik_id = env("DAPODIK_SERVER_NPSN") . "-" . $request->nisn;

            $data = $request->input();
            $data["peserta_didik_id"] = $peserta_didik_id;
            unset($data["kelas"]);
            $data["rombongan_belajar_id"] = $request->kelas;

            // // Tambah Siswa Baru
            Siswa::create($data);
            MapingKelas::create($data);


            return redirect()->back()->with("success", "Data siswa $request->name Berhasil Di Tambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //

        // dd($siswa->presensi->count());
        return view("admin.siswa.siswaShow", [
            'siswa' => $siswa,
            "pageTitle" => "Edit Data Siswa $siswa->name",
            "Sakit" => $siswa->presensi()->where("presensi", "Sakit"),
            "Izin" => $siswa->presensi()->where("presensi", "Izin"),
            "Alfa" => $siswa->presensi()->where("presensi", "Alfa"),
            "Hadir" => $siswa->presensi()->where("presensi", "Hadir")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view("admin.siswa.siswaEdit", ['siswa' => $siswa, "pageTitle" => "Edit Data Siswa $siswa->name"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        // return $request->input();
        $siswa->update($request->input());
        return redirect()->route("siswa.show",$siswa->id)->with("success", "Data siswa $siswa->name Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $namaSiswa = $siswa->name;
        $siswa->delete();
        return redirect()->back()->with("success", "Data Siswa $namaSiswa Berhasil Di hapus");
    }
}
