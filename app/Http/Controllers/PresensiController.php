<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\Pembelajaran;
use App\Models\presensi;
use App\Models\presensiGuru;
use App\Models\presensiLog;
use App\Models\presensiSiswaMapel;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("welcome", ['dataKelas' => kelas::all()]);
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

        // dd($request->input());

        $form = $request;
        $kelas_id = kelas::where("rombongan_belajar_id", $form->kelas)->first()->id;
        $kelas_id_str = kelas::where("rombongan_belajar_id", $form->kelas)->first()->kelas;

        $presensiCount = [
            'kelas' => $form->kelas,
            'dataMapel' => $form->mapel,
            'sakit' => ['total' => 0, 'nama' => []],
            'izin' => ['total' => 0, 'nama' => []],
            'alfa' => ['total' => 0, 'nama' => []],
            'hadir' => ['total' => 0, 'nama' => []],
            'total' => 0,
        ];


        // Send To DB
        $getidPresesniGuru = presensiGuru::updateOrCreate(
            [
                "kelas_id" => $kelas_id,
                "tanggal" => date("d/m/Y"),
                "guru" => $form->mapel["guru"],
            ],
            [
                "kelas_id" => $kelas_id,
                "tanggal" => date("d/m/Y"),
                "jamke" => json_encode($form->mapel["jamke"], JSON_PRETTY_PRINT),
                "guru" => $form->mapel["guru"],
                "maple" => $form->mapel["mapel"],
                "presensi" => $form->mapel["presensi"],
                "tugas" => $form->mapel["tugas"],
            ]
        );

        // return $form->presensi;
        foreach ($form->presensi as $key => $value) {
            foreach ($value as $nama => $kehadiran) {

                presensi::updateOrCreate([
                    'siswa_id' => $key,
                    'kelas_id' => $kelas_id,
                    'tanggal' => date("d/m/Y")
                ], [
                    'siswa_id' => $key,
                    'kelas_id' => $kelas_id,
                    'presensi' => $kehadiran,
                    'tanggal' => date("d/m/Y")
                ]);

                presensiSiswaMapel::updateOrCreate(
                    [
                        "siswa_id" => $key,
                        "presensi_guru_id" => $getidPresesniGuru->id,
                        "tanggal" => date("d/m/Y"),
                    ],
                    [
                        "siswa_id" => $key,
                        "presensi_guru_id" => $getidPresesniGuru->id,
                        'presensi' => $kehadiran,
                        "tanggal" => date("d/m/Y"),
                    ]
                );

                if ($kehadiran == "Hadir") {
                    # code...
                    $presensiCount["hadir"]["total"] = $presensiCount["hadir"]["total"] + 1;
                    $presensiCount["hadir"]["nama"][] = $nama;
                } elseif ($kehadiran == "Sakit") {
                    # code...
                    $presensiCount["sakit"]["total"] = $presensiCount["sakit"]["total"] + 1;
                    $presensiCount["sakit"]["nama"][] = $nama;
                } elseif ($kehadiran == "Izin") {
                    # code...
                    $presensiCount["izin"]["total"] = $presensiCount["izin"]["total"] + 1;
                    $presensiCount["izin"]["nama"][] = $nama;
                } elseif ($kehadiran == "Alfa") {
                    # code...
                    $presensiCount["alfa"]["total"] = $presensiCount["alfa"]["total"] + 1;
                    $presensiCount["alfa"]["nama"][] = $nama;
                }
            }
        }

        $presensiCount["total"] = $presensiCount["hadir"]["total"] + $presensiCount["sakit"]["total"] + $presensiCount["izin"]["total"] + $presensiCount["alfa"]["total"];
        // dump($kelas_id_str);
        $getPembelajaran = Pembelajaran::where("pembelajaran_id", $form->mapel["mapel"])->first();
        // dd($getPembelajaran);
        $data = [
            'kelas' => $kelas_id_str,
            'waliKelas' => kelas::find($kelas_id_str)->Guru->nama,
            'namaMapel' => $getPembelajaran->namaPelajaran,
            'guruMapel' => $getPembelajaran->guru->nama,
            'guruPresensi' => $form->mapel["presensi"],
            'Hadir' => $presensiCount["hadir"]["total"],
            'Sakit' => $presensiCount["sakit"]["total"],
            'Izin' => $presensiCount["izin"]["total"],
            'Alfa' => $presensiCount["alfa"]["total"],
            'siswaSakit' => $presensiCount["sakit"]["nama"],
            'siswaIzin' => $presensiCount["izin"]["nama"],
            'siswaAlfa' => $presensiCount["alfa"]["nama"],
        ];
        $dataPresensiForm = $form->input();
        unset($dataPresensiForm["_token"]);
        // return $form;
        // return $presensiCount;
        // return $dataPresensiForm;
        // return $data;

        presensiLog::create([
            'kelas_id' => $kelas_id,
            "dataPresensiForm" => json_encode($dataPresensiForm, JSON_PRETTY_PRINT),
            "dataPresensi" => json_encode($presensiCount, JSON_PRETTY_PRINT),
        ]);


        return view('PresensiReview', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presensi $presensi)
    {
        //
    }
}
