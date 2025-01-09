<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dapo;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\pembelajaranController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\rekapCetakController;
use App\Http\Controllers\rekapGuruController;
use App\Http\Controllers\rekapSiswaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use App\Models\Dapo_Log;
use App\Models\Dapo_Sekolah;
use App\Models\kelas;
use App\Models\Pembelajaran;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', function () {
    return redirect()->route("Authentication.index");
})->middleware("guest")->name("login");
Route::get('logout', function (Request $request) {
    Auth::logout();

    session()->invalidate();

    session()->regenerateToken();

    return redirect('/');
})->name("logout")->middleware("auth");
Route::resource('/', PresensiController::class)->names("home")->middleware("Absen");
Route::prefix('admin')->middleware("auth")->group(function () {
    Route::get("/", [Dashboard::class, 'index'])->name("dashboard");

    Route::resource('/kelas', KelasController::class);
    Route::get("/kelas/mapingKelas/{Kelas}", function (kelas $Kelas) {

        return view("admin.kelas.kelasTambahsiswa", ['kelas' => $Kelas, "siswa" => Siswa::all(), "pageTitle" => "Edit Daftar Siswa kelas $Kelas->kelas"]);
    })->name("kelas.maping");
    Route::get("/kelas/mapingKelas/pembelajran/{Kelas}", function (kelas $Kelas) {

        return view("admin.pembelajaran.pembelajaran", ['pembelajaran' => Pembelajaran::where("kelas_id", $Kelas->id)->get(), "pageTitle" => "Daftar Pembelajaran kelas $Kelas->kelas"]);
        // return view("admin.kelas.kelasTambahsiswa", ['kelas' => $Kelas, "siswa" => Siswa::all(), "pageTitle" => "Edit Daftar Siswa kelas $Kelas->kelas"]);
    })->name("kelas.pembelajaran");

    Route::prefix("/Rekap")->group(function () {
        Route::resource('/Siswa', rekapSiswaController::class)->names("rekapSiswa");
        Route::get('/SiswaPerKelas/{kelas}', [rekapSiswaController::class, "kelas"])->name("rekapSiswaPerkelas");
        Route::resource('/Guru', rekapGuruController::class)->names("rekapGuru");
        Route::resource('/Cetak', rekapCetakController::class)->names("rekapCetak");
    });

    Route::resource('pembelajaran', pembelajaranController::class);
    Route::resource("/siswa", SiswaController::class);
    Route::resource("/guru", GuruController::class);
    Route::resource("/Users", UsersController::class);
    Route::resource('/Dapodik', Dapo::class);
    Route::prefix("settings")->group(function () {
        Route::resource("setting", SettingController::class);
        Route::put('/userAdmin', [SettingController::class, 'userAdmin'])->name("setting.userAdmin");
    });
});
Route::resource("Authentication", Authentication::class)->middleware("guest");

Route::prefix("install")->group(function () {

    route::get("/", function () {
        return view("install/register");
    })->name("install")->middleware("Install");
    route::get("/Setup", function () {
        $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") .
            "/WebService/getSekolah?npsn=" .
            env("DAPODIK_SERVER_NPSN");
        $getBody = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),
        ])->get($url)->body();
        $rows = json_decode($getBody)->rows;

        $getDapodikData = Dapo_Sekolah::create([
            "sekolah_id" =>  $rows->sekolah_id,
            "nama" =>  $rows->nama,
            "nss" =>  $rows->nss,
            "npsn" =>  $rows->npsn,
            "bentuk_pendidikan_id_str" =>  $rows->bentuk_pendidikan_id_str,
            "status_sekolah_str" =>  $rows->status_sekolah_str,
            "alamat_jalan" =>  $rows->alamat_jalan,
            "rt" =>  $rows->rt,
            "rw" =>  $rows->rw,
            "dusun" =>  $rows->dusun,
            "desa_kelurahan" =>  $rows->desa_kelurahan,
            "kecamatan" =>  $rows->kecamatan,
            "kabupaten_kota" =>  $rows->kabupaten_kota,
            "provinsi" =>  $rows->provinsi,
            "kode_pos" =>  $rows->kode_pos,
            "kode_wilayah" =>  $rows->kode_wilayah,
            "email" =>  $rows->email,
            "website" =>  $rows->website,
        ]);

        Setting::updateOrCreate([
            "schoolName" => $getDapodikData->nama,
            "schoolAddress" => "Rt. " . $getDapodikData->rt . ", Rw. " . $getDapodikData->rw . "," . $getDapodikData->dusun . "," . $getDapodikData->desa_kelurahan . "," . $getDapodikData->kecamatan . "," . $getDapodikData->kabupaten_kota . "," . $getDapodikData->provinsi,
            "schoolNPSN" => env("DAPODIK_SERVER_NPSN"),
            "dapodikToken" => env("DAPODIK_SERVER_Token"),
            "dapodikIP" => env("DAPODIK_SERVER_IP"),
            "dapodikPort" => env("DAPODIK_SERVER_PORT"),
        ]);

        Dapo_Log::created([
            "title" => "Selesai mengunduh Data Sekolah Dari Dapodik",
            "icon" => "mdi-database-arrow-down-outline",
            "icon_color" => "success",
            "time" => date("H:i:s:u"),
        ]);
        $path = base_path('.env');
        $test = file_get_contents($path);
        file_put_contents($path, str_replace('APP_INSTALL=true', 'APP_INSTALL=false', $test));
        $test = file_get_contents($path);
        return view("install/clear");
    })->name("install.setup")->middleware("Install");
    route::Post("/", function () {
        if (request("code") == "kode rahasia") {
            # code...
            Artisan::call("migrate:fresh --force");
            $getAdminRole = Role::create([
                'role' => "Administrator"
            ]);

            $getAdminID = User::create([
                "name" => "Administrator",
                "email" => request("email"),
                "password" => bcrypt(request("password")),
            ]);

            UserRole::create([
                "role_id" => $getAdminRole->id,
                "user_id" => $getAdminID->id,
            ]);

            $path = base_path('.env');
            $test = file_get_contents($path);

            if (file_exists($path)) {

                file_put_contents($path, str_replace('DAPODIK_SERVER_PORT=', 'DAPODIK_SERVER_PORT=' . request("dapo_port"), $test));
                $test = file_get_contents($path);
                file_put_contents($path, str_replace('DAPODIK_SERVER_NPSN=', 'DAPODIK_SERVER_NPSN=' . request("dapo_npsn"), $test));
                $test = file_get_contents($path);
                file_put_contents($path, str_replace('DAPODIK_SERVER_IP=', 'DAPODIK_SERVER_IP="' . request("dapo_ip") . '"', $test));
                $test = file_get_contents($path);
                file_put_contents($path, str_replace('DAPODIK_SERVER_Token=', 'DAPODIK_SERVER_Token="' . request("dapo_token") . '"', $test));
            };
            return redirect()->route("install.setup");
        } else {
            return back()->with("reg", "registration code not found");
        }
    })->name("register")->middleware("Install");
});
