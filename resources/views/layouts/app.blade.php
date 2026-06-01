<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-TECH LOG SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6EEF6;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background: linear-gradient(to right, #3c5e82, #5e82ac);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .table thead th {
            background-color: #425A73 !important;
            color: white !important;
            border: none;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #BFC9D9;
        }

        .form-control:focus {
            border-color: #6E3DAA;
            box-shadow: 0 0 0 0.15rem rgba(110, 61, 170, 0.25);
        }

        h5 {
            color: #0E1A2B;
            font-weight: bold;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast-success {
            background-color: #d1f5e0;
            border-left: 5px solid #198754;
            color: #0f5132;
            border-radius: 10px;
            min-width: 280px;
        }

        #closeToastBtn {
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin-left: auto;
            background: none;
            border: none;
            color: #0f5132;
            padding: 0 4px;
            line-height: 1;
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

    {{-- TOAST ALERT --}}
    @if(session('success'))
    <div class="toast-container">
        <div id="successToast" class="toast toast-success p-3 d-flex align-items-center gap-2 shadow show" role="alert">
            <span style="font-size:20px;">✅</span>
            <div class="fw-semibold">{{ session('success') }}</div>
        </div>
    </div>
@endif

    {{-- MODAL KONFIRMASI HAPUS --}}
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0" style="background-color: #5e82ac;">
                    <h6 class="modal-title fw-bold" style="color: #0E1A2B;">
                        ⚠️  Konfirmasi Hapus
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-1">Apakah Anda yakin ingin menghapus catatan kehadiran</p>
                    <p class="fw-bold fs-5 mb-0" id="namaHapus" style="color: #1c2125;"></p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button type="button" class="btn fw-bold px-4" style="background-color: #BFC9D9; color: #0E1A2B;"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <form id="formHapus" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn fw-bold px-4 text-white" style="background-color:#dc3545;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-3">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const toast = document.getElementById('successToast');
            if (toast) {
                setTimeout(function () {
                    toast.style.display = 'none';
                }, 3000);
            }
        });

        function konfirmasiHapus(id, nama, url) {
            document.getElementById('namaHapus').innerText = nama;
            document.getElementById('formHapus').action = url;
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }
    </script>
</body>

</html>