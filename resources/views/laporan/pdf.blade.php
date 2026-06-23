<!DOCTYPE html>
<html>
<head>
    <title>Laporan Presensi</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background: #2c3e50; color: white; }
    </style>
</head>
<body>

<h3 style="text-align:center;">LAPORAN PRESENSI PEGAWAI</h3>

<table>
    <tr>
        <th>Nama</th>
        <th>NIP</th>
        <th>Tanggal</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Status</th>
    </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->user->nip }}</td>
        <td>{{ $item->tanggal }}</td>
        <td>{{ $item->jam_masuk }}</td>
        <td>{{ $item->jam_pulang }}</td>
        <td>{{ $item->keterangan_kehadiran }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>