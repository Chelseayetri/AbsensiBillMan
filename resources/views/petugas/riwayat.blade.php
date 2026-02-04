@extends('layouts.main')

@section('title', 'Riwayat Absensi')

@section('content')
<div class="card">
    <h2>Riwayat Absensi</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Kegiatan</th>
        </tr>

        @forelse ($data as $row)
        <tr>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->waktu }}</td>
            <td>{{ ucfirst($row->status) }}</td>
            <td>{{ $row->jumlah_kegiatan }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" align="center">Belum ada data absensi</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
