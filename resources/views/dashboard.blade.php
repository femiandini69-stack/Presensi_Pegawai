@extends('layouts.app')

@section('content')
<div class="container">
    <div id="realtime-clock" class="mb-3 text-muted"></div>

    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3 shadow">
                <h6>Total Pegawai</h6>
                <h3>{{ $totalPegawai }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3 shadow">
                <h6>Hadir</h6>
                <h3>{{ $hadir }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white p-3 shadow">
                <h6>Izin / Sakit</h6>
                <h3>{{ $izin + $sakit }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white p-3 shadow">
                <h6>Belum Absen</h6>
                <h3>{{ $belumAbsen }}</h3>
            </div>
        </div>
    </div>

    <div class="mt-4 card p-4 shadow">
        <h5>Daftar Pengguna</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const options = { 
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', 
            hour: '2-digit', minute: '2-digit', second: '2-digit' 
        };
        // Sekarang elemen 'realtime-clock' sudah tersedia di atas
        const clockElement = document.getElementById('realtime-clock');
        if (clockElement) {
            clockElement.innerText = now.toLocaleDateString('id-ID', options);
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection