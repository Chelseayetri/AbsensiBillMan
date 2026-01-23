<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection
{
    public function collection()
    {
        return Absensi::with('pengguna')->get();
    }
}
