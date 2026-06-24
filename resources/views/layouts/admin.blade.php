<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4>ADMIN</h4>
        <hr>

        <a href="{{ route('dashboard') }}" class="text-white d-block mb-2">Dashboard</a>
        <a href="{{ route('pegawai.index') }}" class="text-white d-block mb-2">Pegawai</a>
        <a href="{{ route('jabatan.index') }}" class="text-white d-block mb-2">Jabatan</a>
        <a href="{{ route('presensi.index') }}" class="text-white d-block mb-2">Presensi</a>

        <hr>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="p-4 w-100">
        @yield('content')
    </div>

</div>

</body>
</html>