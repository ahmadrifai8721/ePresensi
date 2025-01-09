<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\UserRole;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.setting.setting", [
            'pageTitle' => "Settings",
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
        $setting->update($request->input());

        return back()->with("success", "Data Sekolah Berhasil di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function userAdmin()
    {
        $dataUpdate = [];
        foreach (request()->input() as $key => $value) {
            if (!is_null($value)) {
                $dataUpdate[$key] = $value;
            }
        }
        // return $dataUpdate;

        UserRole::where("role_id", 1)->first()->User->update($dataUpdate);
        return back()->with("success", "User Administrator Berhasil Di Update");
    }
}
