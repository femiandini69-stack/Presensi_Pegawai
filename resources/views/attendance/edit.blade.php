@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">

                <h5 class="m-0 text-warning fw-bold">✏️ Edit Catatan Presensi Pegawai</h5>

                <h5 class="m-0 text-warning fw-bold">
                    Edit Catatan Presensi Pegawai
                </h5>

            </div>
            <div class="card-body">
                <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap Pegawai</label>
                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai', $attendance->nama_pegawai) }}">
                        @error('nama_pegawai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $attendance->tanggal) }}">
                        @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" value="{{ old('jam_masuk', $attendance->jam_masuk) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang" value="{{ old('jam_pulang', $attendance->jam_pulang) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <select class="form-select" name="keterangan_kehadiran">
                            <option value="Hadir" {{ $attendance->keterangan_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ $attendance->keterangan_kehadiran == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ $attendance->keterangan_kehadiran == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Dinas Luar" {{ $attendance->keterangan_kehadiran == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning fw-bold">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection