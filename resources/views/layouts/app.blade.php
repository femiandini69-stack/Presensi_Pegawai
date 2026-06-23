<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRESENSIKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fa; }
        .sidebar { width: 260px; height: 100vh; background: #041025; color: white; position: fixed; top: 0; left: 0; padding: 20px; }
        .main-content { margin-left: 260px; padding: 40px; }
        .nav-link { color: rgba(255,255,255,0.8); margin-bottom: 5px; }
        .nav-link:hover, .nav-link.active { color: white; background: #0d6efd !important; }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-white text-center py-2">PRESENSIKU</h4>
    <hr>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li class="mt-3 text-secondary" style="font-size: 0.75rem;">MASTER DATA</li>
        <li><a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->routeIs('jabatan.*') ? 'active' : '' }}">Data Jabatan</a></li>
        <li><a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">Data Pegawai</a></li>
        <li class="mt-3 text-secondary" style="font-size: 0.75rem;">LAPORAN</li>
        <li><a href="{{ route('attendance.index') }}" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">Log Presensi</a></li>
        <li class="mt-3 text-secondary" style="font-size: 0.75rem;">AKUN</li>
        <li><a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">Update Profil</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">Logout</button>
            </form>
        </li>
    </ul>
</div>

<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
