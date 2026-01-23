<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->uuid('id_absensi')->primary();
            $table->uuid('id_pengguna');
            $table->integer('jumlah_kegiatan');
            $table->string('bukti_foto');
            $table->enum('status', ['Hadir','Izin','Sakit','Cuti']);
            $table->date('tanggal');
            $table->time('waktu');
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
