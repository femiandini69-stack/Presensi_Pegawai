<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Pegawai IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
    <style>
        body { 
            background-color: #3775ac; 
            color: #d1d1d1; 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .card { 
            background-color: #204565; 
            border: 1px solid #222; c
            olor: #fff; 
            border-radius: 50; }
        .navbar { 
            background-color: #000; 
            border-bottom: 2px solid #b0cff0; }
        .table { 
            color: #d1d1d1; 
            border-color: #333; }
        .table-hover tbody tr:hover { 
            background-color: #1a1a1a; 
            color: #00d4ff; }
        .form-control, .form-select { 
            background-color: #526b90; 
            border: 1px solid #abbcdb; 
            color: #ffffff; 
            border-radius: 30;
        }
        .form-control:focus { 
            background-color: #94aed1; 
            border-color: #b3d4f8; 
            color: #cef5ce; 
            box-shadow: none; }
        .btn-outline-info { 
            border-radius: 30; 
            text-transform: uppercase; 
            letter-spacing: 1px; }
        .badge { 
            border-radius: 30; 
            font-weight: normal; }
        .text-neon { 
            color: #225089; 
            text-shadow: 0 0 5px #5b7fc0; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('attendance.index') }}">
                <span class="text-neon"></span> Presensi Pegawai IT <span class="text-neon"></span>
            </a>
            <span class="badge bg-danger">SECUREMODE</span>
        </div>
    </nav>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-dark border-info text-info alert-dismissible fade show" role="alert">
                [SYSTEM]: {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======

   <style>
    *{
        font-family: 'Poppins', sans-serif;
    }

    body{
        background-color: #f4f7fb;
        color: #1e293b;
    }

    /* NAVBAR */
    .navbar{
        background: linear-gradient(90deg, #4A7FA7, #B3CFE5);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .navbar-brand{
        color: white !important;
        font-size: 28px;
        font-weight: bold;
    }

    .text-neon{
        color: #dbeafe;
        text-shadow: none;
    }

    /* CARD */
    .card{
        background-color: white;
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        color: #1A3D63;
        overflow: hidden;
    }

    /* JUDUL BUKU PRESENSI */
    .card-title{
        color: #1A3D63;
        font-weight: bold;
    }

    /* TABLE */
    .table{
        color: #1e293b;
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead{
        background-color: #1A3D63;
        color: white;
    }

    .table th{
        padding: 15px;
        text-align: center;
    }

    .table td{
        padding: 14px;
        vertical-align: middle;
        text-align: center;
    }

    .table-hover tbody tr:hover{
        background-color: #eff6ff;
        color: #2563eb;
        transition: 0.2s;
    }

    /* INPUT */
    .form-control,
    .form-select{
        background-color: white;
        border: 1px solid #cbd5e1;
        color: #1e293b;
        border-radius: 10px;
        padding: 10px;
    }

    .form-control:focus,
    .form-select:focus{
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37,99,235,0.2);
    }

    /* BUTTON */
    .btn{
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
        border: none;
    }

    /* TOMBOL TAMBAH */
    .btn-success{
        background-color: #3f6593;
    }

    .btn-success:hover{
        background-color: #35577f;
    }

    /* TOMBOL EDIT */
    .btn-warning{
        background-color: #022c50;
        color: white;
    }

    .btn-warning:hover{
        background-color: #011f39;
        color: white;
    }

    /* TOMBOL HAPUS */
    .btn-danger{
        background-color: #06172e;
    }

    .btn-danger:hover{
        background-color: #040f1f;
    }

    /* ALERT */
    .alert{
        border-radius: 12px;
        border: none;
    }

    .alert-dark{
        background-color: #dcfce7;
        color: #166534;
    }

    /* BADGE */
    .badge{
        border-radius: 20px;
        padding: 8px 12px;
        font-size: 12px;
    }

    /* BADGE KETERANGAN */
    .bg-warning{
        background-color: #0f4c81 !important;
        color: white !important;
    }

    /* RESPONSIVE */
    @media(max-width:768px){
        .navbar-brand{
            font-size: 20px;
        }
    }
</style>
>>>>>>> a623c48 (update css)
