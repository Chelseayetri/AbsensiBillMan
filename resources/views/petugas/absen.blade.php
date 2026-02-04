@extends('layouts.main')

@section('title', 'Form Absensi')

@section('content')
<div class="card">
    <h2>Form Absensi</h2>

    {{-- pesan sukses --}}
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

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

    {{-- JIKA SUDAH ABSEN --}}
    @if(isset($sudahAbsen) && $sudahAbsen)
        <div style="background:#fff3cd; color:#856404; padding:15px; border-radius:5px;">
            <strong>Perhatian!</strong><br>
            Anda sudah melakukan absensi hari ini.
        </div>

    {{-- JIKA BELUM ABSEN --}}
    @else
        <form 
            action="{{ route('petugas.absen.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            <label>Jumlah Kegiatan</label><br>
            <input 
                type="number" 
                name="jumlah_kegiatan" 
                value="{{ old('jumlah_kegiatan') }}"
                required
            ><br><br>

            <label>Status</label><br>
            <select name="status" required>
                <option value="">-- Pilih --</option>
                <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin"  {{ old('status') == 'izin'  ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="cuti"  {{ old('status') == 'cuti'  ? 'selected' : '' }}>Cuti</option>
            </select><br><br>

            <label>Bukti Foto</label><br>
            <input 
                type="file" 
                name="bukti_foto" 
                accept="image/*"
                required
            ><br><br>

            <button type="submit" class="btn">
                Simpan Absensi
            </button>
        </form>
    @endif
</div>
@endsection
