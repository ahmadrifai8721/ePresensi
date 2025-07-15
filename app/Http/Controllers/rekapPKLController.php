<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use App\Models\PresensiPKLModel;
use App\Models\presensiSiswaMapel;
use App\Models\tempatPKL;
use Illuminate\Http\Request;

class rekapPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
        return view("admin/rekap/pkl/table", [
            "pageTitle" => "Rekap PKL",
            "totalSiswa" => PresensiPKLModel::where('tanggal', date("d/m/Y"))->count(),
            "tempat" => tempatPKL::all()
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
    public function show(tempatPKL $Pkl)
    {
        //
        // $Tempat = Tempat::find($Tempat);
        return view("admin/rekap/pkl/show", [
            "pageTitle" => "Rekap PKL Tempat " . $Pkl->nama,
            "totalSiswa" => $Pkl->mapingpkl->count(),
            "Tempat" => $Pkl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, tempatPKL $Pkl)
    {
        //
        // dump($Pkl);
        // return $Pkl->presensiGuru->where("maple", $request->maple_id)->first()->presensiSiswaMapel;

        $data = [
            "pageTitle" => "Edit Rekap PKL Tempat " . $Pkl->nama,
            "totalSiswa" => $Pkl->mapingpkl->count(),
            'tempat' => $Pkl,
            "presensi" => $Pkl->presensiPKL()->orderBy('tanggal', 'desc')->get()

        ];
        // return $data;
        return view("admin/rekap/pkl/edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresensiPKLModel $Pkl)
    {
        //
        $Pkl = PresensiPKLModel::where("id", $request->id)->update([
            "presensi" => $request->presensi
        ]);
        return back()->with("success", "Data Absensi <br> <strong> Berhasil Di Update </strong>");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresensiPKLModel $Pkl) {}

    public function Date(string $Pkl)
    {

        $date = $Pkl == 0 ? date('d/m/Y') : $Pkl;

        return view("admin/rekap/pkl/showDate", [
            "pageTitle" => "Rekap PKL Tanggal " . $date,
            "date" => $date,
        ]);
    }
}
