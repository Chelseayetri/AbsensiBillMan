@extends('layouts.main')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="card">
    <h2>Dashboard Petugas</h2>
    <p>Selamat datang di sistem absensi petugas.</p>
</div>

<div class="card">
    <a href="{{ route('petugas.absen') }}" class="btn">Lakukan Absensi</a>
</div>
@endsection
