<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\kelas;
use App\Models\Pembelajaran;
use App\Models\presensi;
use App\Models\presensiGuru;
use App\Models\presensiLocate;
use App\Models\presensiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class presensiAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return Auth::user()->UserRole->role->id;
        if (Auth::user()->UserRole->role->id == 3) {
            $data = [];
            foreach (Auth::user()->Guru->presensi->load(['kelas', 'pembelajaran']) as $key => $value) {
                $data[$key]['kelas'] = $value->id;
                $data[$key]['kelas'] = $value->kelas->kelas;
                $data[$key]['jamke'] = json_decode($value->jamke, true);
                $data[$key]['presensi'] = $value->presensi;
                $data[$key]['tugas'] = $value->tugas;
                $data[$key]['namaPelajaran'] = $value->pembelajaran->namaPelajaran;
            }

            return $data;
        } else {
            return Auth::user()->Siswa->presensi;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * presensi siswa [
         * siswa_id => 1,
         * kelas_id => 1,
         * presensi => 'Hadir',
         * tanggal => '2023-10-01',
         * longitude => 123.456,
         * latitude => 78.910,
         * ]
         *
         *presensi guru [
         *mapel => 1,
         *tanggal => '2023-10-01',
         *jamke => [1, 2, 3],
         *ptk_id => 1,
         *kelas_id => 1,
         *presensi => 'Hadir',
         *tugas => 'Tugas 1',
         *longitude => 123.456,
         *latitude => 78.910,
         * ]
         *
         */

        $data =  $request->all();
        $data['tanggal'] = date("d/m/Y");
        $data['role'] = Auth::user()->UserRole->role->id;
        $kelas = kelas::find($data['kelas_id']);
        if (!$kelas) {
            return response()->json(
                [
                    'message' => 'Kelas Tidak Ditemukan',
                ],
                404
            );
        }

        $data['kelas_id'] = $kelas->id;


        // return response()->json(
        //     [
        //         'message' => $data,
        //     ],
        // );

        if (Auth::user()->UserRole->role->id == 3) {

            $mapel = Pembelajaran::where('namaPelajaran', $data['mapel'])
                ->first();

            if (!$kelas && !$mapel) {
                return response()->json(
                    [
                        'message' => 'Kelas and Mapel Tidak Ditemukanan',
                    ],
                    404
                );
            }
            $data['mapel'] = $mapel->pembelajaran_id;
            if (
                Auth::user()->Guru->presensi->where('tanggal', $data['tanggal'])
                ->where('maple', $data['mapel'])
                ->count() > 0
            ) {
                return response()->json(
                    [
                        'message' => 'You have already submitted your attendance for today.',
                    ],
                    403
                );
            }

            // return response()->json(
            //     [
            //         'message' => $data,
            //     ],
            //     403
            // );
            $presensi = presensiGuru::create([
                'maple' => $data['mapel'],
                'tanggal' => date("d/m/Y"),
                'jamke' => "[" . json_encode($data['jamke']) . "]",
                'guru' => Auth::user()->Guru->ptk_id,
                'kelas_id' => $data['kelas_id'],
                'presensi' => $data['presensi'],
                'tugas' => $data['tugas'] ?? null,

            ]);
            $presensiLocate = presensiLocate::create([
                'presensi_id' => $presensi->id,
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
            ]);
            return response()->json([
                'message' => 'Presensi created successfully',
                'dataPresensi' => $presensi,
                'dataPresensiLocate' => $presensiLocate,
            ], 200);
        } else {



            $presensi = presensi::create([
                'tanggal' => $data['tanggal'],
                'siswa_id' => Auth::user()->Siswa->id,
                'kelas_id' => $data['kelas_id'],
                'presensi' => $data['presensi'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
            ]);
            presensiLocate::create([
                'presensi_id' => $presensi->id,
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
            ]);
            return response()->json($presensi, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(presensi $presensi)
    {
        //
        return response()->json(
            [
                'message' => 'This endpoint is not implemented yet.',
            ],
            501
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, presensi $presensi)
    {
        //
        return response()->json(
            [
                'message' => 'This endpoint is not implemented yet.',
            ],
            501
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presensi $presensi)
    {
        //
        return response()->json(
            [
                'message' => 'This endpoint is not implemented yet.',
            ],
            501
        );
    }
    public function pembelajaran()
    {
        //
        $data = Pembelajaran::all();

        return response()->json(
            $data,
            200
        );
    }
    public function kelas()
    {
        //
        $data = Kelas::all()
            ->load(['guru', "pembelajaran"])->map(function ($kelas) {
                return [
                    'id' => $kelas->id,
                    'kelas' => $kelas->kelas,
                    'guru' => $kelas->guru->ptk_id,
                    'pembelajaran' => $kelas->pembelajaran->pluck('pembelajaran_id'),
                ];
            });

        return response()->json(
            $data,
            200
        );
    }
    public function kelasShow(kelas $kelas)
    {
        //
        $kelas->load(['guru', 'pembelajaran',]);

        if (!$kelas) {
            return response()->json(
                [
                    'message' => 'Kelas not found',
                ],
                404
            );
        }

        return response()->json(
            $kelas,
            200
        );
    }
    public function ptk()
    {
        //
        $data = Guru::all();

        if (!$data) {
            return response()->json(
                [
                    'message' => 'Kelas not found',
                ],
                404
            );
        }

        return response()->json(
            $data,
            200
        );
    }
    public function ptkShow($guru)
    {
        //
        $data = Guru::where('ptk_id', $guru)
            ->with(['kelas', 'pembelajaran'])
            ->first();

        if (!$data) {
            return response()->json(
                [
                    'message' => 'Kelas not found',
                ],
                404
            );
        }

        return response()->json(
            $data,
            200
        );
    }
}
