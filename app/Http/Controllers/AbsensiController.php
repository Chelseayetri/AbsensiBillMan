<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\KontrolAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AbsensiController extends Controller
{
    // ================= PETUGAS =================

    public function formAbsen()
    {
        $akses = KontrolAkses::latest()->first();

        if (!$akses || !$akses->sedang_dibuka) {
            return redirect()->back()->with('error', 'Absensi sedang ditutup oleh admin.');
        }

        return view('petugas.absen');
    }

    public function simpanAbsen(Request $request)
    {
        $request->validate([
            'jumlah_kegiatan' => 'required|integer',
            'status' => 'required|in:Hadir,Izin,Sakit,Cuti',
            'bukti_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('bukti_foto')->store('bukti_absensi', 'public');

        Absensi::create([
            'id_pengguna'      => Auth::user()->id_pengguna,
            'jumlah_kegiatan'  => $request->jumlah_kegiatan,
            'bukti_foto'       => $path,
            'status'           => $request->status,
            'tanggal'          => now()->toDateString(),
            'waktu'            => now()->toTimeString(),
            'dibuat_pada'      => now(),
        ]);

        return redirect()->route('petugas.riwayat')->with('success', 'Absensi berhasil disimpan.');
    }

    public function riwayatPetugas()
    {
        $data = Absensi::where('id_pengguna', Auth::user()->id_pengguna)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('petugas.riwayat', compact('data'));
    }

    // ================= ADMIN =================

    public function monitoring()
    {
        $data = Absensi::with('pengguna.peran')->orderBy('tanggal', 'desc')->get();
        return view('admin.monitoring', compact('data'));
    }

    public function bukaTutup(Request $request)
    {
        KontrolAkses::create([
            'sedang_dibuka' => $request->status == 'buka',
            'waktu_buka'    => $request->status == 'buka' ? now() : null,
            'waktu_tutup'   => $request->status == 'tutup' ? now() : null,
            'diubah_oleh'   => Auth::user()->id_pengguna,
        ]);

        return back()->with('success', 'Status absensi berhasil diubah.');
    }

    public function exportExcel()
    {
        return Excel::download(new AbsensiExport, 'laporan_absensi.xlsx');
    }
}
