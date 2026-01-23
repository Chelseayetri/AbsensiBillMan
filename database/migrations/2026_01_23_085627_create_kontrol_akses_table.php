<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontrol_akses', function (Blueprint $table) {
            $table->uuid('id_kontrol')->primary();
            $table->boolean('sedang_dibuka');
            $table->dateTime('waktu_buka')->nullable();
            $table->dateTime('waktu_tutup')->nullable();
            $table->uuid('diubah_oleh');

            $table->foreign('diubah_oleh')->references('id_pengguna')->on('pengguna')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontrol_akses');
    }
};
