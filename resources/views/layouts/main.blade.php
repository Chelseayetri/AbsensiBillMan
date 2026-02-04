<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Petugas')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }
        header {
            background: #1e293b;
            color: white;
            padding: 15px 30px;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        .container {
            padding: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            background: #2563eb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        table th {
            background: #f1f5f9;
        }
    </style>
</head>
<body>

<header>
    <strong>Sistem Absensi</strong>
    <nav>
        <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
        <a href="{{ route('petugas.absen') }}">Absen</a>
        <a href="{{ route('petugas.riwayat') }}">Riwayat</a>
    </nav>
</header>

<div class="container">
    @yield('content')
</div>

</body>
</html>
