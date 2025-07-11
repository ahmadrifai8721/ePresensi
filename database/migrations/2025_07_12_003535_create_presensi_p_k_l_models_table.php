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
        Schema::create('presensi_p_k_l_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("siswa_id");
            $table->foreignId("tempat_p_k_l_id");
            $table->string("presensi");
            $table->string("bukti");
            $table->string("tanggal");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_p_k_l_models');
    }
};
