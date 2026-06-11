@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow-sm border-0 rounded-4 mb-3">

            {{-- HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #425A73; border-radius: 16px 16px 0 0;">
                <h5 class="fw-bold m-0" style="color: #E6EEF6;">
                    Buku Presensi Pegawai
                </h5>
                <a href="{{ route('attendance.create') }}" class="btn fw-bold text-white" style="background-color:#789aca;">
                    + Tambah Data
                </a>
            </div>

            <div class="card-body">

                 @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

                {{-- SEARCH + FILTER --}}
                <form method="GET" action="{{ route('attendance.index') }}" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIP..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="filter" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Hadir" {{ request('filter') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="Sakit" {{ request('filter') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="Izin" {{ request('filter') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                <option value="Dinas Luar" {{ request('filter') == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn fw-bold text-white w-100" style="background-color:#206abc;">
                                Cari
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('attendance.index') }}" class="btn btn-secondary w-100">
                                Reset
                            </a>
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
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Status</th>
                                <th>    </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pegawai }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jam_masuk }}</td>

                                    {{-- JAM PULANG --}}
                                    <td>
                                        @if(in_array($item->keterangan_kehadiran, ['Sakit', 'Izin']))
                                            <span class="text-muted">-</span>
                                        @else
                                            {{ $item->jam_pulang
                                            ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i')
                                            : \Carbon\Carbon::parse($item->jam_masuk)->addHours(8)->format('H:i') }}
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @php $status = $item->keterangan_kehadiran; @endphp
                                        @if($status == 'Hadir')
                                            <span class="badge" style="background-color: #198754;">Hadir</span>
                                        @elseif($status == 'Sakit')
                                            <span class="badge" style="background-color: #dc3545;">Sakit</span>
                                        @elseif($status == 'Izin')
                                            <span class="badge" style="background-color: #ffc107; color:#000;">Izin</span>
                                        @elseif($status == 'Dinas Luar')
                                            <span class="badge" style="background-color: #0d6efd;">Dinas Luar</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $status }}</span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                <td>
    <a href="{{ route('attendance.edit', $item->id) }}"
        class="btn btn-sm text-white"
        style="background-color: #5e82ac;">
        Edit
    </a>

    <form action="{{ route('attendance.destroy', $item->id) }}"
        method="POST"
        style="display:inline-block;"
        onsubmit="return confirm('Yakin ingin menghapus data {{ $item->nama_pegawai }}?')">

        @csrf
        @method('DELETE')

        <button type="submit"
            class="btn btn-sm text-white"
            style="background-color: #3c5e82;">
            Hapus
        </button>

    </form>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- REKAP TOTAL --}}
                @if($attendances->count() > 0)
                    @php
                        $totalHadir = $attendances->where('keterangan_kehadiran', 'Hadir')->count();
                        $totalSakit = $attendances->where('keterangan_kehadiran', 'Sakit')->count();
                        $totalIzin = $attendances->where('keterangan_kehadiran', 'Izin')->count();
                        $totalDinas = $attendances->where('keterangan_kehadiran', 'Dinas Luar')->count();
                        $totalSemua = $attendances->count();
                    @endphp

                    <div class="mt-4">
                        <h6 class="fw-bold mb-3" style="color:#425A73;">Rekap Kehadiran Pegawai</h6>
                        <div class="d-flex gap-3">

                            <div class="flex-fill text-center py-3 px-2 rounded-3 border border-2 border-white shadow-sm"
                                style="background-color:#e8f5e9;">
                                <div class="fw-bold fs-3 mb-1" style="color: #198754;">{{ $totalHadir }}</div>
                                <div class="small fw-semibold" style="color: #198754;">Hadir</div>
                            </div>

                            <div class="flex-fill text-center py-3 px-2 rounded-3 border border-2 border-white shadow-sm"
                                style="background-color:#fdecea;">
                                <div class="fw-bold fs-3 mb-1" style="color: #dc3545;">{{ $totalSakit }}</div>
                                <div class="small fw-semibold" style="color: #dc3545;">Sakit</div>
                            </div>

                            <div class="flex-fill text-center py-3 px-2 rounded-3 border border-2 border-white shadow-sm"
                                style="background-color:#fff8e1;">
                                <div class="fw-bold fs-3 mb-1" style="color: #d4a000;">{{ $totalIzin }}</div>
                                <div class="small fw-semibold" style="color: #d4a000;">Izin</div>
                            </div>

                            <div class="flex-fill text-center py-3 px-2 rounded-3 border border-2 border-white shadow-sm"
                                style="background-color:#e8f0fe;">
                                <div class="fw-bold fs-3 mb-1" style="color: #0d6efd;">{{ $totalDinas }}</div>
                                <div class="small fw-semibold" style="color: #0d6efd;">Dinas Luar</div>
                            </div>

                            <div class="flex-fill text-center py-3 px-2 rounded-3 border border-2 border-white shadow-sm"
                                style="background-color:#E6EEF6;">
                                <div class="fw-bold fs-3 mb-1" style="color: #425A73;">{{ $totalSemua }}</div>
                                <div class="small fw-semibold" style="color: #425A73;">Total</div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection