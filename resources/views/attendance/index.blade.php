@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0 rounded-4 mb-3">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center"
             style="background-color:#E6EEF6;">

            <h5 class="fw-bold m-0" style="color:#425A73;">
                Buku Presensi Pegawai
            </h5>

            <a href="{{ route('attendance.create') }}"
               class="btn fw-bold text-white"
               style="background-color:#789aca;">
                + Tambah Data
            </a>
        </div>

        <div class="card-body">

            {{-- SEARCH + FILTER --}}
            <form method="GET" action="{{ route('attendance.index') }}" class="mb-3">
                <div class="row g-2">

                    <div class="col-md-4">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari nama atau NIP..."
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
                        <button class="btn fw-bold text-white w-100"
                                style="background-color:#206abc;">
                            Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('attendance.index') }}"
                           class="btn btn-secondary w-100">
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
                            <th>Aksi</th>
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
                            <td>{{ $item->jam_pulang }}</td>

                            <td>
    @php
        $status = $item->keterangan_kehadiran;
    @endphp

    @if($status == 'Hadir')
        <span class="badge" style="background-color:#198754;">Hadir</span>

    @elseif($status == 'Sakit')
        <span class="badge" style="background-color:#dc3545;">Sakit</span>

    @elseif($status == 'Izin')
        <span class="badge" style="background-color:#ffc107; color:#000;">Izin</span>

    @elseif($status == 'Dinas Luar')
        <span class="badge" style="background-color:#0d6efd;">Dinas Luar</span>

    @else
        <span class="badge bg-secondary">
            {{ $status }}
        </span>
    @endif
</td>

                            <td>
                                <a href="{{ route('attendance.edit', $item->id) }}"
                                   class="btn btn-sm text-white"
                                   style="background-color:#5e82ac;">
                                    Edit
                                </a>

                                <form action="{{ route('attendance.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm text-white"
                                            style="background-color:#3c5e82;"
                                            onclick="return confirm('Apakah kelompok Anda yakin ingin menghapus catatan kehadiran atas nama {{ $item->nama_pegawai }}?')">
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

        </div>
    </div>

</div>
@endsection