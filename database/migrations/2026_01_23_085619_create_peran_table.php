<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peran', function (Blueprint $table) {
            $table->uuid('id_peran')->primary();
            $table->string('nama_peran', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peran');
    }
};
