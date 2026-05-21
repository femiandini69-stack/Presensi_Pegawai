<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-TECH LOG SYSTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background: linear-gradient(90deg, #2563eb, #3b82f6);
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
            color: #1e293b;
            overflow: hidden;
        }

        /* TABLE */
        .table{
            color: #1e293b;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead{
            background-color: #2563eb;
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
        }

        .btn-success{
            background-color: #22c55e;
            border: none;
        }

        .btn-success:hover{
            background-color: #16a34a;
        }

        .btn-warning{
            color: white;
        }

        .btn-danger{
            background-color: #ef4444;
            border: none;
        }

        .btn-danger:hover{
            background-color: #dc2626;
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

        /* RESPONSIVE */
        @media(max-width:768px){
            .navbar-brand{
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('attendance.index') }}">
                <span class="text-neon">📋</span> SISTEM PRESENSI PEGAWAI
            </a>

            <span class="badge bg-light text-primary">
                ONLINE
            </span>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>

</body>
</html>