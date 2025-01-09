<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dapo__sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string("sekolah_id");
            $table->string("nama");
            $table->string("nss");
            $table->string("npsn");
            $table->string("bentuk_pendidikan_id_str");
            $table->string("status_sekolah_str");
            $table->string("alamat_jalan");
            $table->string("rt");
            $table->string("rw");
            $table->string("dusun");
            $table->string("desa_kelurahan");
            $table->string("kecamatan");
            $table->string("kabupaten_kota");
            $table->string("provinsi");
            $table->string("kode_pos");
            $table->string("kode_wilayah");
            $table->string("email");
            $table->string("website");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapo__sekolahs');
    }
};
