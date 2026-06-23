@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4 mb-3">
        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background-color: #425A73; border-radius: 16px 16px 0 0;">
            <h5 class="fw-bold m-0" style="color: #E6EEF6;">Buku Presensi Pegawai</h5>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('attendance.create') }}" class="btn fw-bold text-white" style="background-color:#789aca;">+ Tambah Data</a>
            @endif
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- SEARCH + FILTER --}}
            <form method="GET" action="{{ route('attendance.index') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIP..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="filter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Hadir" {{ request('filter') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ request('filter') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ request('filter') == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Dinas Luar" {{ request('filter') == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                            <option value="Cuti" {{ request('filter') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Alpha" {{ request('filter') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn fw-bold text-white w-100" style="background-color:#206abc;">Cari</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('attendance.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background-color:#E6EEF6;">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Divisi</th>
                            <th>NIP</th>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td><span class="badge" style="background-color:#5e82ac;">{{ $item->jabatan }}</span></td>
                                <td><span class="badge bg-info text-dark">{{ $item->divisi }}</span></td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}</td>
                                <td>
                                    @if(in_array($item->keterangan_kehadiran, ['Sakit','Izin','Cuti']))
                                        <span class="text-muted">-</span>
                                    @else
                                        {{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : \Carbon\Carbon::parse($item->jam_masuk)->addHours(8)->format('H:i') }}
                                    @endif
                                </td>
                                <td>
                                    @if($item->keterangan_kehadiran == 'Hadir') <span class="badge bg-success">Hadir</span>
                                    @elseif($item->keterangan_kehadiran == 'Sakit') <span class="badge bg-danger">Sakit</span>
                                    @elseif($item->keterangan_kehadiran == 'Izin') <span class="badge bg-warning text-dark">Izin</span>
                                    @elseif($item->keterangan_kehadiran == 'Dinas Luar') <span class="badge bg-primary">Dinas Luar</span>
                                    @elseif($item->keterangan_kehadiran == 'Cuti') <span class="badge bg-info">Cuti</span>
                                    @elseif($item->keterangan_kehadiran == 'Alpha') <span class="badge bg-dark">Alpha</span>
                                    @else <span class="badge bg-dark">Alpha</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->bukti)
                                        <a href="{{ asset('bukti/' . $item->bukti) }}" target="_blank">
                                            <img src="{{ asset('bukti/' . $item->bukti) }}" width="50" height="50" class="img-thumbnail" style="object-fit:cover;">
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('attendance.edit', $item->id) }}" class="btn btn-sm text-white" style="background-color:#5e82ac;">Edit</a>
                                        <form action="{{ route('attendance.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-white" style="background-color:#3c5e82;">Hapus</button>
                                        </form>
                                    @else
                                        <small class="text-muted">Read-only</small>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="11" class="text-center text-muted">Data tidak ditemukan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- REKAP --}}
            @if($attendances->count() > 0)
                <div class="mt-4">
                    <h6 class="fw-bold mb-3" style="color:#425A73;">Rekap Kehadiran</h6>
                    <div class="d-flex gap-2">
                        <div class="flex-fill text-center py-2 rounded shadow-sm" style="background:#e8f5e9;"><div class="fw-bold text-success">{{ $attendances->where('keterangan_kehadiran', 'Hadir')->count() }}</div><small>Hadir</small></div>
                        <div class="flex-fill text-center py-2 rounded shadow-sm" style="background:#fdecea;"><div class="fw-bold text-danger">{{ $attendances->where('keterangan_kehadiran', 'Sakit')->count() }}</div><small>Sakit</small></div>
                        <div class="flex-fill text-center py-2 rounded shadow-sm" style="background:#fff8e1;"><div class="fw-bold text-warning">{{ $attendances->where('keterangan_kehadiran', 'Izin')->count() }}</div><small>Izin</small></div>
                        <div class="flex-fill text-center py-2 rounded shadow-sm" style="background:#e8f0fe;"><div class="fw-bold text-primary">{{ $attendances->where('keterangan_kehadiran', 'Cuti')->count() }}</div><small>Cuti</small></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection