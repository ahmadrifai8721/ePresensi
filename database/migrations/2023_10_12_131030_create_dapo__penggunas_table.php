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
        Schema::create('dapo__penggunas', function (Blueprint $table) {
            $table->id();
            $table->string("ptk_id")->nullable();
            $table->string("peserta_didik_id")->nullable();
            $table->string("peran_id_str");
            $table->string("username");
            $table->string("password");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapo__penggunas');
    }
};
