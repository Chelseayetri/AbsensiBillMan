<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE absensi
            DROP CONSTRAINT IF EXISTS absensi_status_check
        ");

        DB::statement("
            ALTER TABLE absensi
            ADD CONSTRAINT absensi_status_check
            CHECK (status IN ('hadir','izin','sakit','cuti'))
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE absensi
            DROP CONSTRAINT IF EXISTS absensi_status_check
        ");
    }
};
