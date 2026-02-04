@extends('layouts.main')

@section('title', 'Form Absensi')

@section('content')
<div class="card">
    <h2>Form Absensi</h2>

    {{-- pesan error --}}
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    {{-- pesan validasi --}}
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- FORM YANG BENAR --}}
    <form 
        action="{{ route('petugas.absen.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf

        <label>Jumlah Kegiatan</label><br>
        <input type="number" name="jumlah_kegiatan" required><br><br>

        <label>Status</label><br>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="hadir">hadir</option>
            <option value="izin">izin</option>
            <option value="sakit">sakit</option>
            <option value="cuti">cuti</option>
        </select><br><br>

        <label>Bukti Foto</label><br>
        <input type="file" name="bukti_foto" accept="image/*"><br><br>

        <button type="submit" class="btn">
            Simpan Absensi
        </button>
    </form>
</div>
@endsection
