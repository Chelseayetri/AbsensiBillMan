<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('id_pengguna')->primary();
            $table->uuid('id_peran');
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('kata_sandi', 255);
            $table->string('foto')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('id_peran')->references('id_peran')->on('peran')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
