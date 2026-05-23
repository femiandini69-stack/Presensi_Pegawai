@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 text-success fw-bold">Formulir Catatan Presensi Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label fw-bold">Nama Lengkap Pegawai</label>
                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}" placeholder="Masukkan nama pegawai">
                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label fw-bold">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 19950215123">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jam_masuk" class="form-label fw-bold">Jam Masuk</label>
                            <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk', date('H:i')) }}">
                            @error('jam_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_kehadiran" class="form-label fw-bold">Keterangan Kehadiran</label>
                        <select class="form-select @error('keterangan_kehadiran') is-invalid @enderror" id="keterangan_kehadiran" name="keterangan_kehadiran">
                            <option value="" disabled selected>-- Pilih Keterangan --</option>
                            <option value="Hadir" {{ old('keterangan_kehadiran') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ old('keterangan_kehadiran') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ old('keterangan_kehadiran') == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Dinas Luar" {{ old('keterangan_kehadiran') == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                        </select>
                        @error('keterangan_kehadiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success fw-bold">Simpan Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection