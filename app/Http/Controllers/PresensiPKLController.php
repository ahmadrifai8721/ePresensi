<?php

namespace App\Http\Controllers;

use App\Models\PresensiPKLModel;
use Illuminate\Http\Request;

class PresensiPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view("pklPresensi");
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
        // return $request;
        // return $request->file('presensi_file')->getSize();
        $bukti = null;
        if ($request->hasFile('presensi_file')) {
            $bukti = $request->file('presensi_file')->getClientOriginalName();
        }
        if ($bukti == null) {
            return redirect()->back()->withErrors(['presensi_file' => 'Bukti presensi harus diunggah.']);
        } elseif (PresensiPKLModel::where(['bukti' => $bukti, 'tempat_p_k_l_id' =>  $request->tempat_p_k_l_id])->first()) {
            return redirect()->back()->withErrors(['presensi_file' => 'Bukti presensi Sudah Pernah Di Upload.']);
        } elseif ($request->file('presensi_file')->getSize() > 10 * 1024 * 1024) {
            return redirect()->back()->withErrors(['presensi_file' => 'Ukuran file maksimal 10 MB.']);
        } else {
            $request->file('presensi_file')->storeAs('buktiPresensiPKL', $bukti, 'public');
        }
        // return $bukti;
        // return PresensiPKLModel::where(['bukti' => $bukti, 'siswa_id' => $request->siswa_id])->first();
        PresensiPKLModel::create([
            'siswa_id' => $request->siswa_id,
            'tempat_p_k_l_id' => $request->tempat_p_k_l_id,
            'presensi' => $request->presensi,
            'bukti' => $bukti,
            'tanggal' => date("d/m/Y"),
        ]);
        return redirect()->back()->with('sudah', 'Presensi PKL Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PresensiPKLModel $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PresensiPKLModel $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresensiPKLModel $pkl)
    {
        //

        // return $request;
        // return $pkl;
        $pkl->update([
            'presensi' => $request->presensi,
        ]);
        return redirect()->back()->with('success', 'Presensi PKL Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresensiPKLModel $pkl)
    {
        //
        // return $pkl;
        $nama = $pkl->siswa->name;
        $Tempat = $pkl->Tempat->Tempat;
        $tanggal = $pkl->tanggal;
        if ($pkl->bukti && file_exists(public_path("storage/buktiPresensiPKL/{$pkl->bukti}"))) {
            unlink(public_path("storage/buktiPresensiPKL/{$pkl->bukti}"));
        }
        $pkl->delete();
        return back()->with("success", "Data Absensi $nama Tempat $Tempat Tanggal $tanggal <br> <strong> Berhasil Di Hapus </strong>");
    }
}
