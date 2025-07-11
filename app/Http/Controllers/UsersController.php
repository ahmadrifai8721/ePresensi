<?php

namespace App\Http\Controllers;

use App\Models\Dapo_GTK;
use App\Models\Dapo_PD;
use App\Models\Guru;
use App\Models\MobileAccess;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\user;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("admin.Users.Users", ['Users' => user::all()->sortByDesc("id"), "pageTitle" => "Daftar Users"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $dataGTK = Dapo_GTK::all();
        $dataSiswa = Dapo_PD::all();
        // dd($dataGTK);
        $pengguna = $dataGTK->concat($dataSiswa);
        // dd($dataGTK->count(), $dataSiswa->count(), $pengguna->count());
        return view("admin.Users.UsersCreate", [
            "pageTitle" => "Buat Users",
            "pengguna" => $pengguna,
            "Role" => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return $request->all();

        $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users,email',
            "password" => 'required',
        ], [
            'name.required' => ":attribute Tidak Boleh Kosong",
            'email.required' => ":attribute Tidak Boleh Kosong",
            'email.email' => "Format :attribute Tidak Didukung",
            'email.unique' => ":attribute Sudah Di Gunakan",
            'password.required' => ":attribute Tidak Boleh Kosong",
        ]);

        $getUserID = user::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        UserRole::create([
            "user_id" => $getUserID->id,
            "role_id" => $request->Role
        ]);

        return back()->with("success", "user $getUserID->name Berhasil Di tambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(user $User)
    {
        //
        // return $User;
        $User->load("UserRole");
        $User->createToken("token")->plainTextToken;
        $User->tokens()->delete();
        $tokenLast = $User->createToken("token")->plainTextToken;
        $User->tokens;
        $User->token = $tokenLast;
        $MobileAccess = MobileAccess::updateOrCreate([
            "user_id" => $User->id
        ], [
            "device_token" => $tokenLast,
            "pin" => hash("crc32c", Date::now()),
            "user_id" => $User->id
        ]);
        $User->mobleAccess = $MobileAccess;
        return back()->with("success", "Token Berhasil Di Buat")->with("token", $tokenLast);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $User)
    {
        //
        // return $User;
        return view("admin.Users.UsersEdit", ['Users' => $User, "pageTitle" => "Edit Data users $User->name", "Role" => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $User)
    {
        if ($request->input("password") != null && $request->input("password") != "Password Dapodik" && $request->input("password") != "NISN Siswa") {
            $request->merge(["password" => bcrypt($request->input("password"))]);
            // dd($request->all());
            $User->update($request->all());

            UserRole::where("user_id", $User->id)->update([
                "role_id" => $request->input("Role")
            ]);

            return back()->with("success", "Data Berhasil Di Update");
        } else {
            unset($request["password"]);
            $User->update($request->all());

            UserRole::where("user_id", $User->id)->update([
                "role_id" => $request->input("Role")
            ]);
            return back()->with("success", "Data Berhasil Di Update");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $User)
    {

        // return $User;
        $User->delete();
        return back()->with("success", "Data Berhasil Di Hapus");
    }
}
