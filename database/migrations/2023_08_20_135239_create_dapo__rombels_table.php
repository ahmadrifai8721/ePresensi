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
        Schema::create('dapo__rombels', function (Blueprint $table) {
            $table->id();
            $table->string("rombongan_belajar_id");
            $table->string("nama");
            $table->string("tingkat_pendidikan_id_str");
            $table->string("ptk_id");
            $table->string("ptk_id_str");
            $table->string("jurusan_id_str");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapo__rombels');
    }
};
