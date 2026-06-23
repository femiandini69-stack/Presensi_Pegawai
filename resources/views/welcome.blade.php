<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM PRESENSI PEGAWAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="d-flex justify-content-between p-3 px-5 align-items-center" style="background-color: #101B3A;">
        <div class="fw-bold fs-4 text-white">SISTEM PRESENSI PEGAWAI</div>
        <div class="d-flex gap-4">
            <span class="text-white">Fitur</span>
            <span class="text-white">Tentang</span>
            <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-white">Masuk</a>
        </div>
    </nav>

    <div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="text-center p-5 shadow-sm bg-white rounded-4 border-0">
            <h1 class="display-5 fw-bold mb-3" style="color: #101B3A;">Selamat Datang di Sistem Presensi Pegawai</h1>
            <p class="lead text-muted mb-4">
                Presensi Cepat, Data Akurat.<br>
                Sistem terintegrasi untuk pengelolaan kinerja perusahaan Anda.
            </p>
            
            @guest
                <a href="{{ route('login') }}" class="btn btn-lg text-white px-5" 
                   style="background-color: #101B3A; border-radius: 25px;">
                   Mulai Masuk
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-lg text-white px-5" 
                   style="background-color: #101B3A; border-radius: 25px;">
                </a>
            @endguest
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html