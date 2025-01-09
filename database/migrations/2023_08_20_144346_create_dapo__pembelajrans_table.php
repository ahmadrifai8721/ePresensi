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
        Schema::create('dapo__pembelajrans', function (Blueprint $table) {
            $table->id();
            $table->string("pembelajaran_id");
            $table->string("rombongan_belajar_id");
            $table->string("nama_mata_pelajaran");
            $table->string("ptk_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapo__pembelajrans');
    }
};
