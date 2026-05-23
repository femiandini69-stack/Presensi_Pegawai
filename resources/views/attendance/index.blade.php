@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold" style="color:#1A3D63;">
    Buku Presensi Harian Pegawai
</h5>
        <a href="{{ route('attendance.create') }}" class="btn btn-success btn-sm fw-bold">+ Tambah Presensi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary">{{ $item->nip }}</span></td>
                            <td class="fw-bold text-secondary">{{ $item->nama_pegawai }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td><span class="text-success fw-bold">{{ $item->jam_masuk }}</span></td>
                            <td>
                                <span class="text-danger fw-bold">{{ $item->jam_pulang ?? '--:--:--' }}</span>
                            </td>
                            <td>
                                @if($item->keterangan_kehadiran == 'Hadir')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($item->keterangan_kehadiran == 'Sakit')
                                    <span class="badge bg-warning text-dark">Sakit</span>
                                @elseif($item->keterangan_kehadiran == 'Izin')
                                    <span class="badge bg-info text-dark">Izin</span>
                                @else
                                    <span class="badge bg-purple style bg-dark">Dinas Luar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('attendance.edit', $item->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                                
                                <!-- Form Delete dengan Konfirmasi -->
                                <form action="{{ route('attendance.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah kelompok Anda yakin ingin menghapus catatan kehadiran atas nama {{ $item->nama_pegawai }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data presensi hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection