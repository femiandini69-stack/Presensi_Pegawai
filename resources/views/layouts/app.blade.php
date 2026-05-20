<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-TECH LOG SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #3775ac; color: #d1d1d1; font-family: 'Courier New', Courier, monospace; }
        .card { background-color: #153857; border: 1px solid #222; color: #fff; border-radius: 0; }
        .navbar { background-color: #000; border-bottom: 2px solid #b0cff0; }
        .table { color: #d1d1d1; border-color: #333; }
        .table-hover tbody tr:hover { background-color: #1a1a1a; color: #00d4ff; }
        .form-control, .form-select { 
            background-color: #0a0a0a; border: 1px solid #333; color: #cbfbcb; border-radius: 0;
        }
        .form-control:focus { background-color: #0f0f0f; border-color: #b3d4f8; color: #cef5ce; box-shadow: none; }
        .btn-outline-info { border-radius: 0; text-transform: uppercase; letter-spacing: 1px; }
        .badge { border-radius: 0; font-weight: normal; }
        .text-neon { color: #aaecf9; text-shadow: 0 0 5px #b8e8f1; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('attendance.index') }}">
                <span class="text-neon">>_</span> SYSTEM_ADMIN@LOG_CENTER
            </a>
            <span class="badge bg-danger">SECURE_MODE</span>
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