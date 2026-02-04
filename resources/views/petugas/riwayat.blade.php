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
            <th>Bukti Foto</th>
        </tr>

        @forelse ($data as $row)
        <tr>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->waktu }}</td>
            <td>{{ ucfirst($row->status) }}</td>
            <td>{{ $row->jumlah_kegiatan }}</td>
            <td>
                @if($row->bukti_foto)
                    <a href="{{ asset('storage/' . $row->bukti_foto) }}" target="_blank">
                        <img 
                            src="{{ asset('storage/' . $row->bukti_foto) }}" 
                            alt="Bukti Foto"
                            style="width:60px; border-radius:4px;"
                        >
                    </a>
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Belum ada data absensi</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
