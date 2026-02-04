<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AbsensiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CATATAN SEMENTARA (PENTING)
    |--------------------------------------------------------------------------
    | - Auth DISABLE
    | - KontrolAkses DISABLE
    | - id_pengguna pakai dummy = 1
    | Tujuan: preview UI petugas
    |--------------------------------------------------------------------------
    */

    private function idPengguna()
    {
        return 'dbe771ba-2ed6-4756-ba98-d19460e72ef9'; // dummy user
    }

    // ================= PETUGAS =================

    public function formAbsen()
    {
        // LANGSUNG TAMPILKAN FORM
        return view('petugas.absen');
    }

public function simpanAbsen(Request $request)
{
    $idPengguna = $this->idPengguna();

    // Cegah absen 2x sehari
    $cek = Absensi::where('id_pengguna', $idPengguna)
        ->whereDate('tanggal', now()->toDateString())
        ->first();

    if ($cek) {
        return redirect()->route('petugas.riwayat')
            ->with('error', 'Absensi hari ini sudah tercatat.');
    }

    $request->validate([
        'jumlah_kegiatan' => 'required|integer|min:0',
        'status' => 'required|in:hadir,izin,sakit,cuti',
        'bukti_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = $request->file('bukti_foto')
        ->store('bukti_absensi', 'public');

    Absensi::create([
        'id_pengguna'     => $idPengguna,
        'jumlah_kegiatan' => $request->jumlah_kegiatan,
        'bukti_foto'      => $path,
        'status'          => strtolower($request->status),
        'tanggal'         => now()->toDateString(),
        'waktu'           => now()->toTimeString(),
        'dibuat_pada'     => now(),
    ]);

    return redirect()->route('petugas.riwayat')
        ->with('success', 'Absensi berhasil disimpan.');
}


    public function riwayatPetugas()
    {
        $idPengguna = $this->idPengguna();

        $data = Absensi::where('id_pengguna', $idPengguna)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('petugas.riwayat', compact('data'));
    }

    // ================= ADMIN (NANTI) =================

    public function exportExcel()
    {
        return Excel::download(new AbsensiExport, 'laporan_absensi.xlsx');
    }
}
