@extends('layouts.main')

@section('title', 'Form Absensi')

@section('content')
<div class="card">
    <h2>Form Absensi</h2>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('petugas.absen.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Jumlah Kegiatan</label><br>
        <input type="number" name="jumlah_kegiatan" required><br><br>

        <label>Status</label><br>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="cuti">Cuti</option>
        </select><br><br>

        <label>Bukti Foto</label><br>
        <input type="file" name="bukti_foto" accept="image/*"><br><br>

        <button type="submit" class="btn">Simpan Absensi</button>
    </form>
</div>
@endsection
