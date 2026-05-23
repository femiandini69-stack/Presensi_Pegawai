<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-TECH LOG SYSTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#E6EEF6;
            font-family:'Segoe UI',sans-serif;
        }

        .navbar{
            background: linear-gradient(to right, #3c5e82, #5e82ac);
        }

        .navbar-brand{
            color:white !important;
            font-weight:bold;
            font-size:22px;
            letter-spacing:1px;
        }

        .card{
            border:none;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        .btn-primary-custom{
            background-color:#6E3DAA;
            color:white;
            border:none;
            border-radius:10px;
            padding:8px 16px;
            font-weight:600;
        }

        .btn-primary-custom:hover{
            background-color:#5a3290;
            color:white;
        }

        .btn-edit{
            background-color:#425A73;
            color:white;
            border:none;
            border-radius:8px;
            padding:5px 12px;
        }

        .btn-edit:hover{
            background-color:#35485d;
            color:white;
        }

        .btn-delete{
            background-color:#0E1A2B;
            color:white;
            border:none;
            border-radius:8px;
            padding:5px 12px;
        }

        .btn-delete:hover{
            background-color:#000814;
            color:white;
        }

        .table thead th{
            background-color:#425A73 !important;
            color:white !important;
            border:none;
        }

        .table{
            border-radius:12px;
            overflow:hidden;
        }

        .form-control{
            border-radius:10px;
            border:1px solid #BFC9D9;
        }

        .form-control:focus{
            border-color:#6E3DAA;
            box-shadow:0 0 0 0.15rem rgba(110,61,170,0.25);
        }

        h5{
            color:#0E1A2B;
            font-weight:bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            Sistem Catatan Kehadiran Pegawai
        </a>
    </div>
</nav>

<div class="container py-3">
    @yield('content')
</div>

</body>
</html>