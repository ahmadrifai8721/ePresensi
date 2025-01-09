<?php

namespace App\Http\Livewire;

use App\Models\Dapo_GTK;
use App\Models\Dapo_Jurusan;
use App\Models\Dapo_Log;
use App\Models\Dapo_PD;
use App\Models\Dapo_Pembelajran;
use App\Models\Dapo_Pengguna;
use App\Models\Dapo_Rombel;
use App\Models\Guru;
use App\Models\kelas;
use App\Models\MapingKelas;
use App\Models\Pembelajaran;
use App\Models\Role;
use App\Models\Siswa;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DapodikImport extends Component
{
    public $GTK;
    public $log;
    public $pesertaDidik;
    public $Pembelajaran;
    public $kelas;

    public $GTK_progres = 0;
    public $pesertaDidik_progres = 0;
    public $Pembelajaran_progres = 0;
    public $kelas_progres = 0;
    public $userUploadFinis;
    public $kelasUploadFinis = false;
    public $pembelajaranUploadFinis = false;

    public $importStart;
    public $importFinis;

    public $Notice = "";
    public $noticeText = "";


    public function getListeners()
    {
        return [
            "syncDapodik",
            "ImportGTK",
            "ImportPengguna",
            "ImportPD",
            "ImportRombel",
            "tambahSiswakeRombel",
            "clearData",
            "GTK_progres",
            "pesertaDidik_progres",
            "Pembelajaran_progres",
            "kelas_progres",
            "UploadProgres",
            "UploadGuru",
        ];
    }

    public function mount()
    {
        $this->log = collect([
            [
                "title" => "Selamat datang di System singkron dapodik ",
                "icon" => "mdi-sync",
                "icon_color" => "info",
                "time" => date("H:i:s:u"),
            ],
        ]);

        // cek data User
        $countLocalsiswa = Siswa::all()->count();
        $countDaposiswa = Dapo_PD::all()->count();
        $this->pesertaDidik = $countLocalsiswa . " / " . $countDaposiswa;
        // cek data gtk
        $countLocalguru = Guru::all()->count();
        $countDapogtk = Dapo_GTK::all()->count();
        $this->GTK = $countLocalguru . " / " . $countDapogtk;

        if (
            (($countLocalguru + $countLocalsiswa) > 0)
        ) {

            $this->userUploadFinis = false;
            $this->GTK_progres = 100;
            $this->pesertaDidik_progres = 100;
            $this->kelasUploadFinis = true;
            // dump(true);
        } elseif (($countDapogtk + $countDaposiswa) == 0) {
            $this->userUploadFinis = false;
        } else {
            // dump(false);
            $this->userUploadFinis = true;
        }
        // cek data kelas
        $countLocalkelas = kelas::all()->count();
        $countDapoRombel = Dapo_Rombel::all()->count();
        $this->kelas = $countLocalkelas . " / " . $countDapoRombel;

        if (
            $countLocalkelas > 0
        ) {
            $this->kelasUploadFinis = false;
            $this->kelas_progres = 100;
            $this->pembelajaranUploadFinis = true;
        } elseif ($countLocalguru == 0) {
            $this->kelasUploadFinis = false;
        } else {
            $this->kelasUploadFinis = true;
        }
        // cek data pembelajaran
        $countLocalPmebelajaran = Pembelajaran::all()->count();
        $countDapoPembelajaran = Dapo_Pembelajran::all()->count();
        $this->Pembelajaran = $countLocalPmebelajaran . " / " . $countDapoPembelajaran;

        if (
            $countLocalPmebelajaran > 0
        ) {
            $this->pembelajaranUploadFinis = false;
            $this->Pembelajaran_progres = 100;
        } elseif ($countLocalkelas == 0) {
            $this->pembelajaranUploadFinis = false;
        } else {
            $this->pembelajaranUploadFinis = true;
        }
    }

    public function syncDapodik()
    {

        if (env("DAPODIK_SERVER_PORT") == "") {
            # code...
            $this->Notice = 'danger';
            $this->noticeText = "Server Tidak Ditemukan";
            return;
        } else {
            # code...
            $this->Notice = 'warning';
            $this->noticeText = "Mulai Syncron data";
            $this->importStart = date("d-m-Y H:i:s");
            $log = [
                "title" => "Menyiapkan penyimpanan",
                "icon" => "mdi-database-plus",
                "icon_color" => "warning",
                "time" => date("H:i:s:u"),
            ];
            $this->log->push($log);
            for ($i = 0; $i < 10; $i++) {
            }
            $this->emit("clearData");
        }
    }

    public function clearData()
    {
        Dapo_GTK::truncate();
        Dapo_PD::truncate();
        Dapo_Rombel::truncate();
        Dapo_Pembelajran::truncate();
        Dapo_Pengguna::truncate();

        $this->GTK = "0 / 0";
        $this->pesertaDidik = "0 / 0";
        $this->Pembelajaran = "0 / 0";
        $this->kelas = "0 / 0";
        $this->pesertaDidik_progres = 0;
        $this->GTK_progres = 0;
        $this->kelas_progres = 0;
        $this->Pembelajaran_progres = 0;
        $this->userUploadFinis = false;
        $this->kelasUploadFinis = false;
        $this->pembelajaranUploadFinis = false;
        $this->emit("ImportRombel");
    }

    public function ImportGTK()
    {

        $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") . "/WebService/getGtk?npsn=" . env("DAPODIK_SERVER_NPSN");
        $getBody = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),
        ])->get($url)->body();
        $log = [
            "title" => "Selesai mengunduh Data GTK Dari Dapodik",
            "icon" => "mdi-database-arrow-down-outline",
            "icon_color" => "success",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $getBody = json_decode($getBody);
        $Total = $getBody->results;

        $data = $getBody->rows;

        foreach ($data as $key => $value) {
            Dapo_GTK::create([
                "ptk_id" => $value->ptk_id,
                "jenis_kelamin" => $value->jenis_kelamin,
                "nama" => $value->nama,
                "nuptk" => $value->nuptk,
                "nip" => $value->nip,
                "tempat_lahir" => $value->tempat_lahir,
                "tanggal_lahir" => $value->tanggal_lahir,
                "jenis_ptk_id_str" => $value->jenis_ptk_id_str,
                "bidang_studi_terakhir" => $value->pendidikan_terakhir . " " . $value->bidang_studi_terakhir,
            ]);
        };

        $this->GTK = "0 / $Total";
        $this->ImportPengguna();
    }
    public function ImportPengguna()
    {

        $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") . "/WebService/getPengguna?npsn=" . env("DAPODIK_SERVER_NPSN");
        $getBody = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),
        ])->get($url)->body();
        $log = [
            "title" => "Selesai mengunduh Data Pengguna Dari Dapodik",
            "icon" => "mdi-database-arrow-down-outline",
            "icon_color" => "success",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $getBody = json_decode($getBody);
        $Total = $getBody->results;

        $data = $getBody->rows;

        foreach ($data as $key => $value) {
            Dapo_Pengguna::create([
                "username" => $value->username,
                "peran_id_str" => $value->peran_id_str,
                "password" => $value->password,
                "ptk_id" => $value->ptk_id,
                "peserta_didik_id" => $value->peserta_didik_id
            ]);
            Role::updateOrCreate([
                "role" => $value->peran_id_str
            ]);
        };
        $this->userUploadFinis = true;
        $this->importSelesai();
    }

    private function importSelesai($upload = false)
    {

        $this->importFinis = date("d-m-Y H:i:s");

        if ($upload) {
            $log = [
                "title" => "Singkron Data Ke Local Selesai",
                "icon" => "mdi-database-check",
                "icon_color" => "success",
                "time" => date("H:i:s:u"),
            ];

            $this->Notice = 'success';
            $this->noticeText = "Selsai Syncron data";
        } else {
            $log = [
                "title" => "Selesai mengunduh Data Dari Dapodik",
                "icon" => "mdi-database-check",
                "icon_color" => "success",
                "time" => date("H:i:s:u"),
            ];

            $this->userUploadFinis = true;
            $this->kelasUploadFinis = false;
            $this->pembelajaranUploadFinis = false;
        }

        $this->log->push($log);
        // dump($upload);
        Dapo_Log::create([
            "Start" => $this->importStart,
            "Finis" => $this->importFinis,
            "Log" => json_encode([
                "Jumlah Data GTK" => Dapo_GTK::all()->count(),
                "Jumlah Data Pembelajaran" => Dapo_Pembelajran::all()->count(),
                "Jumlah Data Rombongan Belajar" => Dapo_Rombel::all()->count(),
                "Jumlah Data Siswa" => Dapo_PD::all()->count(),
                "Log Import" => $this->log->all()
            ])
        ]);
    }
    public function ImportPD()
    {
        $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") .
            "/WebService/getPesertaDidik?npsn=" .
            env("DAPODIK_SERVER_NPSN");
        $getBody = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),
        ])->get($url)->body();
        $log = [
            "title" => "Selesai mengunduh Data Siswa Dari Dapodik",
            "icon" => "mdi-database-arrow-down-outline",
            "icon_color" => "success",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $getBody = json_decode($getBody);
        $Total = $getBody->results;

        $data = $getBody->rows;
        // return $data;
        foreach ($data as $key => $value) {
            // return $value;
            Dapo_PD::create([
                "peserta_didik_id" => $value->peserta_didik_id,
                "nama" => $value->nama,
                "nisn" => $value->nisn == null ? 000000 : $value->nisn,
                "jenis_kelamin" => $value->jenis_kelamin,
                "rombongan_belajar_id" => $value->rombongan_belajar_id,
            ]);
        };

        $this->pesertaDidik = "0 / $Total";
        $this->emit("ImportGTK");
    }
    public function ImportRombel()
    {
        $url = "http://" . env("DAPODIK_SERVER_IP") . ":" . env("DAPODIK_SERVER_PORT") .
            "/WebService/getRombonganBelajar?npsn=" .
            env("DAPODIK_SERVER_NPSN");
        $getBody = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DAPODIK_SERVER_Token'),
        ])->get($url)->body();
        $log = [
            "title" => "Selesai mengunduh Data Kelas Dari Dapodik",
            "icon" => "mdi-database-arrow-down-outline",
            "icon_color" => "success",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $getBody = json_decode($getBody);
        $Total = 0;

        $data = $getBody->rows;
        $i = 0;
        $pembelajaran = collect([]);

        foreach ($data as $key => $value) {
            if ($value->jenis_rombel == 1) {
                Dapo_Rombel::create([
                    "rombongan_belajar_id" => $value->rombongan_belajar_id,
                    "nama" => $value->nama,
                    "tingkat_pendidikan_id_str" => $value->tingkat_pendidikan_id_str,
                    "ptk_id" => $value->ptk_id,
                    "ptk_id_str" => $value->ptk_id,
                    "jurusan_id_str" => Dapo_Jurusan::updateOrCreate([
                        "jurusan_id" => $value->jurusan_id,
                        "jurusan_id_str" => $value->jurusan_id_str
                    ])->id,
                ]);
                $Total = $Total + 1;
                if (sizeof($value->pembelajaran) != 0) {
                    $pembelajaran[$value->rombongan_belajar_id] = $value->pembelajaran;
                }
            }
        };

        $this->kelas = "0 / $Total";

        foreach ($pembelajaran as $key => $value) {
            foreach ($value as $reslut) {
                Dapo_Pembelajran::create([
                    "rombongan_belajar_id" => $key,
                    "pembelajaran_id" => $reslut->pembelajaran_id,
                    "nama_mata_pelajaran" => $reslut->nama_mata_pelajaran,
                    "ptk_id" => $reslut->ptk_id,
                ]);
                $i = $i + 1;
            }
        }

        $this->Pembelajaran = "0 / $i";
        $this->emit("ImportPD");
    }

    public function UploadUser()
    {
        $this->importStart = date("d-m-Y H:i:s");
        $this->pesertaDidik_progres = 0;
        // upload siswa
        $log = [
            "title" => "Singkron Data Siswa",
            "icon" => "mdi-cloud-upload-outline",
            "icon_color" => "warning",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $i = 1;
        $siswaDapodik = Dapo_PD::all();
        $totalData = $siswaDapodik->count();

        foreach ($siswaDapodik as $key => $value) {
            $upload = Siswa::firstOrNew([
                "peserta_didik_id" => $value->peserta_didik_id,
                "name" => $value->nama,
                "jk" => $value->jenis_kelamin,
                "nisn" => $value->nisn,
            ]);
            $upload->save();
            $this->emit("UploadProgres", "user-siswa", $totalData, $i);
            $i++;
        }

        $this->emit("UploadGuru");
    }

    public function UploadGuru()
    {
        $this->GTK_progres = 0;
        // upload Guru
        $log = [
            "title" => "Singkron Data Guru",
            "icon" => "mdi-cloud-upload-outline",
            "icon_color" => "warning",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $i = 1;
        $siswaDapodik = Dapo_GTK::all();
        $totalData = $siswaDapodik->count();

        foreach ($siswaDapodik as $key => $value) {
            $upload = Guru::firstOrNew([
                "ptk_id" => $value->ptk_id,
                "nama" => $value->nama,
            ]);
            $upload->save();
            $this->emit("UploadProgres", "user-gtk", $totalData, $i);
            $i++;
        }

        $this->kelasUploadFinis = true;
        $this->userUploadFinis = false;
        $this->importSelesai(true);
    }


    public function UploadKelas()
    {
        $this->importStart = date("d-m-Y H:i:s");
        $this->kelas_progres = 0;
        // upload Kelas
        $log = [
            "title" => "Singkron Data Kelas",
            "icon" => "mdi-cloud-upload-outline",
            "icon_color" => "warning",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $i = 1;
        $rombelDapodik = Dapo_Rombel::all();
        $totalData = $rombelDapodik->count();
        // return;
        foreach ($rombelDapodik as $key => $value) {
            // dump([
            //     "kelas" => $value->nama,
            //     "rombongan_belajar_id" => $value->rombongan_belajar_id,
            //     "walikelas" => Guru::where("ptk_id", $value->ptk_id)->first()->id,
            //     "tingkat" => $value->tingkat_pendidikan_id_str,
            //     "jurusan" => $value->jurusan_id_str,
            // ]);
            $upload = kelas::firstOrNew([
                "kelas" => $value->nama,
                "rombongan_belajar_id" => $value->rombongan_belajar_id,
                "waliKelas" => Guru::where("ptk_id", $value->ptk_id)->first()->id,
                "tingkat" => $value->tingkat_pendidikan_id_str,
                "jurusan" => $value->jurusan_id_str,
            ]);

            // return $upload;
            // $value->Siswa()->update(['kelas_id' => 1]);
            $upload->save();

            $i++;
            $i;
            $this->emit("UploadProgres", "rombel", $totalData, $i);
        }

        $this->emit("tambahSiswakeRombel", $totalData, $i);
        // return;

    }

    public function tambahSiswakeRombel($totalData, $lasdata)
    {
        $log = [
            "title" => "Menambah kan siswa ke kelas",
            "icon" => "mdi-google-classroom",
            "icon_color" => "warning",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);

        $dataKelas = Dapo_PD::all();
        MapingKelas::truncate();
        foreach ($dataKelas as $key => $value) {
            MapingKelas::create([
                "rombongan_belajar_id" => $value->rombongan_belajar_id,
                "peserta_didik_id" => $value->peserta_didik_id,
            ]);
        }



        $this->emit("UploadProgres", "rombel", $totalData, $lasdata);
        // return;
        $this->kelasUploadFinis = false;
        $this->pembelajaranUploadFinis = true;
        $this->importSelesai(true);
    }


    public function UploadPembelajaran()
    {
        $this->importStart = date("d-m-Y H:i:s");
        $this->Pembelajaran_progres = 0;
        // upload Guru
        $log = [
            "title" => "Singkron Data Pembelajaran",
            "icon" => "mdi-cloud-upload-outline",
            "icon_color" => "warning",
            "time" => date("H:i:s:u"),
        ];
        $this->log->push($log);
        $i = 1;
        $pembelajaranDapodik = Dapo_Pembelajran::all();
        $totalData = $pembelajaranDapodik->count();
        Pembelajaran::truncate();
        foreach ($pembelajaranDapodik as $key => $value) {
            // dump(kelas::where("rombongan_belajar_id", $value->rombongan_belajar_id)->first()->id);
            $upload = Pembelajaran::create([
                "pembelajaran_id" => $value->pembelajaran_id,
                "namaPelajaran" => $value->nama_mata_pelajaran,
                "kelas_id" => kelas::where("rombongan_belajar_id", $value->rombongan_belajar_id)->first()->id,
                "guruMapel" => Guru::where("ptk_id", $value->ptk_id)->first()->id,
            ]);
            $upload->save();
            $this->emit("UploadProgres", "pembelajaran", $totalData, $i);
            $i++;
        }

        $this->kelasUploadFinis = false;
        $this->pembelajaranUploadFinis = true;
        $this->importSelesai(true);
    }

    public function UploadProgres($namaData, $max, $current)
    {
        $percent = $current / $max * 100;

        if ($namaData == "user-siswa") {
            $this->pesertaDidik = $current . " / " . $max;
            $this->pesertaDidik_progres = $percent;
        }

        if ($namaData == "user-gtk") {
            $this->GTK = $current . " / " . $max;
            $this->GTK_progres = $percent;
        }

        if ($namaData == "rombel") {
            $this->kelas = $current . " / " . $max;
            $this->kelas_progres = $percent;
        }

        if ($namaData == "pembelajaran") {
            $this->Pembelajaran = $current . " / " . $max;
            $this->Pembelajaran_progres = $percent;
        }
    }

    public function render()
    {
        return view('livewire.dapodik-import');
    }
}
