\@extends('layouts.app')

@section('content')
<div class="container">

<!-- CLOCK -->
<div id="clock" class="mb-3 text-muted"></div>

<h2>Dashboard Admin Presensi</h2>

<!-- CARD -->
<div class="row">

    <div class="col-md-3">
        <div class="card bg-primary text-white p-3">
            <h6>Total Pegawai</h6>
            <h3>{{ $totalUser }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white p-3">
            <h6>Hadir</h6>
            <h3>{{ $hadir }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white p-3">
            <h6>Izin</h6>
            <h3>{{ $izin }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white p-3">
            <h6>Sakit</h6>
            <h3>{{ $sakit }}</h3>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card p-3 shadow">
            <h5>Grafik Presensi</h5>
            <canvas id="attendanceChart" height="100"></canvas>
        </div>
    </div>
</div>

</div>

<!-- CLOCK SCRIPT (FORMAT FIX INDONESIA) -->
<script>
function updateClock() {
    const now = new Date();

    const hari = now.toLocaleDateString('id-ID', { weekday: 'long' });
    const tanggal = now.getDate();
    const bulan = now.toLocaleDateString('id-ID', { month: 'long' });
    const tahun = now.getFullYear();

    const jam = String(now.getHours()).padStart(2,'0');
    const menit = String(now.getMinutes()).padStart(2,'0');
    const detik = String(now.getSeconds()).padStart(2,'0');

    document.getElementById("clock").innerText =
        `${hari}, ${tanggal} ${bulan} ${tahun} ${jam}.${menit}.${detik}`;
}

setInterval(updateClock, 1000);
updateClock();
</script>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('attendanceChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Hadir', 'Izin', 'Sakit', 'Cuti', 'Alpha'],
        datasets: [{
            label: 'Rekap Presensi',
            data: [
                {{ $hadir }},
                {{ $izin }},
                {{ $sakit }},
                {{ $cuti }},
                {{ $alpha }}
            ],
            backgroundColor: ['green','orange','red','blue','black']
        }]
    }
});
</script>

@endsection