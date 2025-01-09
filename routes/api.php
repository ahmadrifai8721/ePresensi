<?php

use App\Models\Guru;
use App\Models\kelas;
use App\Models\presensiGuru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
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

Route::prefix('Mobile')->group(function () {

    Route::get('users/{Siswa}', function (Siswa $Siswa) {
        return $Siswa;
    });
});
