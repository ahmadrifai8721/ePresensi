<?php

namespace App\Http\Controllers;

use App\Models\Dapo_Jurusan;
use App\Models\Guru;
use App\Models\MapingPKL;
use App\Models\Pembelajaran;
use App\Models\tempatPKL; // Assuming 'tempatPKL::' is the model for PKL
use Illuminate\Http\Request;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("admin.PKL.pkl", ['pkl' => tempatPKL::all()->sortByDesc("pkl", SORT_NUMERIC), "pageTitle" => "Daftar pkl"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.PKL.pklCreate", ["gurus" => Guru::all(), "jurusans" => Dapo_Jurusan::all(), "pageTitle" => "Buat Tempat PKL "]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->input();
        MapingPKL::Where([
            "tempat_p_k_l_id" => $request->pkl_id,
            "siswa_id" => $request->pd_id
        ])->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(tempatPKL $pkl)
    {

        $mapingpkl = $pkl->mapingpkl()->get();
        $siswa = [];
        foreach ($mapingpkl as $key => $value) {
            # code...
            $siswa[] = $value->siswa()->first();
        }
        // return $pkl->mapingpkl;

        return view("admin.PKL.pklShow", ['Siswa' => $siswa, "pkl_id" => $pkl->id, "pageTitle" => "Daftar Diswa pkl $pkl->pkl"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tempatPKL $pkl)
    {
        return view("admin.PKL.pklEdit", ['pkl' => $pkl, "gurus" => Guru::all(), "pageTitle" => "Edit pkl $pkl->pkl"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tempatPKL $pkl)
    {
        $pkl->update($request->input());
        return redirect()->route("adminPKL.index")->with("success", "Data pkl $pkl->pkl Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tempatPKL $pkl)
    {

        MapingPKL::Where([
            "tempat_p_k_l_id" => $pkl->id
        ])->delete();
        $pkl->delete();
        return redirect()->back();
    }

    private function findpkl(String $pkl)
    {
        return tempatPKL::find($pkl);
    }
}
