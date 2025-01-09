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
        Schema::create('dapo__g_t_k_s', function (Blueprint $table) {
            $table->id();
            $table->string("ptk_id");
            $table->string("nuptk")->nullable()->default("Belum Punya NUPTK");
            $table->string("nip")->nullable()->default("Belum Punya NIP");
            $table->string("nama");
            $table->string("tempat_lahir");
            $table->string("tanggal_lahir");
            $table->string("jenis_kelamin");
            $table->string("jenis_ptk_id_str");
            $table->string("bidang_studi_terakhir");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapo__g_t_k_s');
    }
};
