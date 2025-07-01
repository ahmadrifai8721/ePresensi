<?php

use App\Http\Controllers\PresensiApi;
use App\Http\Controllers\presensiAPIController;
use App\Models\Dapo_GTK;
use App\Models\Dapo_Pengguna;
use App\Models\Guru;
use App\Models\kelas;
use App\Models\Pembelajaran;
use App\Models\presensiGuru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('401', function () {
    return response()->json(['Authorization' => 'Unauthorized'], 401);
})->name('api.401');


Route::middleware('auth:sanctum')->get('/user/{dapo_id}', function (Request $request, $dapo_id) {
    return response()->json([
        'user' => Dapo_Pengguna::where('ptk_id', $dapo_id)->get()
    ], 200);
})->name('api.user');
// Route::get("info/{kelas}", function (String $kelas) {

//     if ($kelas == "ipo") {
//         phpinfo();
//     } else {
//         abort(500);
//     }
// });
// Route::get("test/{kelas}", function (String $kelas) {

//     if ($kelas == "ipo") {
//         $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") .

//             "/WebService/getRombonganBelajar?npsn=" .

//             env("DAPODIK_SERVER_NPSN");

//         $getBody = Http::withHeaders([

//             'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),

//         ])->get($url)->status();
//         return $getBody;
//     } else {
//         abort(500);
//     }
// });
Route::prefix('get')->group(function () {
    Route::get("rekapKelas/{kelas}", function (kelas $kelas) {
        $kelasHadir = $kelas->PresensiSiswa->where('presensi', 'Hadir')->count();
        $kelasSakit = $kelas->PresensiSiswa->where('presensi', 'Sakit')->count();
        $kelasIzin = $kelas->PresensiSiswa->where('presensi', 'Izin')->count();
        $kelasAlfa = $kelas->PresensiSiswa->where('presensi', 'Alfa')->count();
        $data = [
            "kelas" => "Hadir : $kelasHadir <br> Sakit : $kelasSakit <br> Izin : $kelasIzin <br> Alfa : $kelasAlfa <br> ",
        ];
        foreach ($kelas->PresensiGuru as $key => $value) {
            $data["Mapel"][$key]["presensi"] = $value->presensi . "( " . $value->tugas . " )";
            $data["Mapel"][$key]["namaMapel"] = $value->pembelajaran->namaPelajaran;
            $data["Mapel"][$key]["namaGuru"] = $value->Guru->nama;
            $data["Mapel"][$key]["Hadir"] = $value->presensiSiswaMapel->where("presensi", "Hadir")->count();
            $data["Mapel"][$key]["Sakit"] = $value->presensiSiswaMapel->where("presensi", "Sakit")->count();
            $data["Mapel"][$key]["Izin"] = $value->presensiSiswaMapel->where("presensi", "Izin")->count();
            $data["Mapel"][$key]["Alfa"] = $value->presensiSiswaMapel->where("presensi", "Alfa")->count();
        }
        if ($kelas->PresensiSiswa->count() > 0) {
            # code...
            return response()->json($data);
        } else {
            return response("Data Tidak Ditemukan", 404);
        }
    });
    Route::get("rekapKelas/{kelas}/{tanggal}/{bulan}/{tahun}", function (kelas $kelas, $tanggal, $bulan, $tahun) {
        $kelasHadir = $kelas->PresensiSiswa
            ->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun)
            ->where('presensi', 'Hadir')->count();
        $kelasSakit = $kelas->PresensiSiswa
            ->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun)
            ->where('presensi', 'Sakit')->count();
        $kelasIzin = $kelas->PresensiSiswa
            ->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun)
            ->where('presensi', 'Izin')->count();
        $kelasAlfa = $kelas->PresensiSiswa
            ->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun)
            ->where('presensi', 'Alfa')->count();
        $data = [];

        foreach ($kelas->PresensiGuru->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun) as $key => $value) {
            $data["Mapel"][$key]["kelas"] = "Hadir : $kelasHadir <br> Sakit : $kelasSakit <br> Izin : $kelasIzin <br> Alfa : $kelasAlfa <br>";
            $data["Mapel"][$key]["presensi"] = $value->presensi . "( " . $value->tugas . " )";
            $data["Mapel"][$key]["namaMapel"] = $value->pembelajaran->namaPelajaran;
            $data["Mapel"][$key]["namaGuru"] = $value->Guru->nama;
            $data["Mapel"][$key]["Kode"] = base64_encode($value->id);
            $data["Mapel"][$key]["KodeKelas"] = base64_encode($kelas->id);
            $data["Mapel"][$key]["Hadir"] = $value->presensiSiswaMapel
                ->where("presensi", "Hadir")->count();
            $data["Mapel"][$key]["Sakit"] = $value->presensiSiswaMapel
                ->where("presensi", "Sakit")->count();
            $data["Mapel"][$key]["Izin"] = $value->presensiSiswaMapel
                ->where("presensi", "Izin")->count();
            $data["Mapel"][$key]["Alfa"] = $value->presensiSiswaMapel
                ->where("presensi", "Alfa")->count();
        }
        if ($kelas->PresensiSiswa->where("tanggal", $tanggal . "/" . $bulan . "/" . $tahun)->count() > 0) {
            # code...
            return response(json_encode($data, JSON_PRETTY_PRINT));
        } else {
            return response("Data Tidak Ditemukan", 404);
        }
    });
});
Route::get("/rekapGuru/{Guru}", function (Guru $Guru) {

    $data = [];
    foreach (presensiGuru::where("guru", $Guru->ptk_id)->get() as $key => $value) {
        # code...
        //  title: 'The Title', // a property!
        //     start: '2024-07-01', // a property!
        //     end: '2024-07-02', // a property! ** see important note below about 'end' **
        //     color : "#ff5b5b"
        $data[$key]["title"] = $value->presensi . "\ndi kelas " . $value->kelas->kelas;
        $data[$key]["start"] = $value->created_at->locale("id_ID")->isoFormat('YYYY-MM-DD');
        // $data[$key]["end"] = $value->created_at->locale("id_ID")->isoFormat('YYYY-MM-DD');
        $data[$key]["color"] = $value->presensi == "Hadir" ? "#10c469" : "#ff5b5b";
    }


    return response()->json($data, 200);
})->name("api.presensiGuru");

Route::prefix('/app')->group(function () {

    route::post("/login", function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // $credentials['password'] = Hash::make($credentials['password']);
        // return response()->json($credentials, 200);

        if (Auth::attempt($credentials)) {

            return response()->json([
                'message' => Auth::user()->mobileAccess
                    ? 'Login successful, please activate your mobile access.'
                    : 'Login Failed, you do not have mobile access. Please contact your administrator.',
                'user' => Auth::user()->load(['mobileAccess'])->only(['name', 'email', 'mobileAccess']),
            ], 200);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    })->name("api.login");

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        if (Auth::user()->UserRole->role->id != 6) {
            return response()->json([
                'nip' => (function () {
                    $gtk = Dapo_GTK::where('ptk_id', Auth::user()->Guru->ptk_id)->first();
                    if ($gtk->nip == null) {
                        if ($gtk->nuptk != null) {
                            return $gtk->nuptk;
                        } else {
                            return 'NIP Atau NUPTK Tidak Ditemukan';
                        }
                    } else {
                        return $gtk->nip;
                    }
                })(),
                'nama' => Auth::user()->name,
                'email' => Auth::user()->email,
                'firstPresensi' => Auth::user()->Guru->presensi->where('tanggal', date('d/m/Y'))->first()
                    ? date("H:i", Auth::user()->Guru->presensi->where('tanggal', date('d/m/Y'))->first()->updated_at->timestamp)
                    : '-:-',
                'lastPresensi' => Auth::user()->Guru->presensi->where('tanggal', date('d/m/Y'))->last()
                    ? date("H:i", Auth::user()->Guru->presensi->where('tanggal', date('d/m/Y'))->last()->updated_at->timestamp)
                    : '-:-',
                'hadir' => Auth::user()->Guru->presensi->where('presensi', 'Hadir')->count(),
                'sakit' => Auth::user()->Guru->presensi->where('presensi', 'Sakit')->count(),
                'izin' => Auth::user()->Guru->presensi->where('presensi', 'Izin')->count(),
                'alfa' => Auth::user()->Guru->presensi->where('presensi', 'Alfa')->count(),

            ], 200);
        } else {
            return response()->json([
                'nip' => (function () {
                    $pd = Siswa::where('nisn', Auth::user()->Siswa->nisn)->first();
                    if ($pd->nisn == null) {
                        return 'NISN Tidak Ditemukan';
                    } else {
                        return $pd->nisn;
                    }
                })(),
                'nama' => Auth::user()->name,
                'email' => Auth::user()->email,
                'firstPresensi' => Auth::user()->Siswa->presensi->where('tanggal', date('d/m/Y'))->first()
                    ? date("H:i", Auth::user()->Siswa->presensi->where('tanggal', date('d/m/Y'))->first()->updated_at->timestamp)
                    : '-:-',
                'lastPresensi' => Auth::user()->Siswa->presensi->where('tanggal', date('d/m/Y'))->last()
                    ? date("H:i", Auth::user()->Siswa->presensi->where('tanggal', date('d/m/Y'))->last()->updated_at->timestamp)
                    : '-:-',
                'hadir' => Auth::user()->Siswa->presensi->where('presensi', 'Hadir')->count(),
                'sakit' => Auth::user()->Siswa->presensi->where('presensi', 'Sakit')->count(),
                'izin' => Auth::user()->Siswa->presensi->where('presensi', 'Izin')->count(),
                'alfa' => Auth::user()->Siswa->presensi->where('presensi', 'Alfa')->count(),

            ], 200);
        }
    })->name('api.user');

    Route::middleware('auth:sanctum')->group(function () {
        route::post("/login/active", function (Request $request) {

            $user = Auth::user();
            if ($user->mobileAccess->pin == $request->code) {

                $user->mobileAccess->device_id = $request->device_id ?? 'Unknown Device';
                $user->mobileAccess->device_name = $request->device_name ?? 'Unknown Device';
                $user->mobileAccess->device_model = $request->device_model ?? 'Unknown Device';
                $user->mobileAccess->device_os = $request->device_os ?? 'Unknown Device';
                $user->mobileAccess->device_os_version = $request->device_os_version ?? 'Unknown Device';
                $user->mobileAccess->save();

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user->load(['mobileAccess',])->setHidden(['mobileAccess.pin', 'mobileAccess.created_at', 'mobileAccess.updated_at'])->only(['name', 'email', 'mobileAccess']),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User does not have mobile access.',
                ], 403);
            }

            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        })->name("api.login.active");
        route::post("/logout", function (Request $request) {

            $user = Auth::user();
            if ($user->mobileAccess->pin == $request->code) {
                $user->mobileAccess->delete();
                $user->currentAccessToken()->delete();

                return response()->json([
                    'message' => 'Logout successful',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User does not have mobile access.',
                ], 403);
            }

            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        })->name("api.logout");

        Route::apiResource("/presensi", presensiAPIController::class)->middleware('Absen');
        Route::get("/pembelajaran", [presensiAPIController::class, 'pembelajaran'])->name("api.pembelajaran");
        Route::get("/kelas", [presensiAPIController::class, 'kelas'])->name("api.kelas");
        Route::get("/kelas/{kelas}", [presensiAPIController::class, 'kelasShow'])->name("api.kelas.show");
        Route::get("/ptk/", [presensiAPIController::class, 'ptk'])->name("api.ptk");
        Route::get("/ptk/{guru}", [presensiAPIController::class, 'ptkShow'])->name("api.ptk.show");
        route::get("/server/{server}", function (String $server) {
            // return response()->json(['status' => 'ok'], 200);
            if ($server == "info") {
                return response()->json([
                    'status' => '200',
                ], 200);
            } elseif ($server == "check") {
                return response()->json([
                    'status' => '200',
                    'message' => 'Server is running',
                    'server_time' => date('Y-m-d H:i'),
                    "last_server_check" => [
                        'User' => auth()->user()->updated_at,
                        'Pembelajaran' => Pembelajaran::all()->map(function ($pembelajaran) {
                            return [
                                'pembelajaran_id' => $pembelajaran->pembelajaran_id,
                                'nama' => $pembelajaran->namaPelajaran,
                                'updated_at' => $pembelajaran->updated_at,
                            ];
                        }),
                        'Kelas' => Kelas::all()->map(function ($kelas) {
                            return [
                                'rombongan_belajar_id' => $kelas->rombongan_belajar_id,
                                'kelas' => $kelas->kelas,
                                'updated_at' => $kelas->updated_at,
                            ];
                        }),
                    ],
                ], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid server request'], 400);
            }
        })->name("api.server");

        // Route::get('users/{Siswa}', function (Siswa $Siswa) {
        //     return $Siswa;
        // });
    });
});
