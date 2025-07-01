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
        Schema::create('mobile_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('device_id')->nullable()->unique();
            $table->string("pin")->unique();
            $table->string("device_name")->nullable();
            $table->string("device_model")->nullable();
            $table->string("device_os")->nullable();
            $table->string("device_os_version")->nullable();
            $table->string("device_token");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_accesses');
    }
};
