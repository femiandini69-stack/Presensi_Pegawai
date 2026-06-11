@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header py-3 border-0 rounded-top-4"
                 style="background-color: #E6EEF6;">

                <h5 class="m-0 fw-bold" style="color: #425A73;">
                    Formulir Catatan Presensi Baru
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_pegawai"
                               class="form-label fw-bold"
                               style="color: #0E1A2B;">
                            Nama Lengkap Pegawai
                        </label>

                        <input type="text"
                               class="form-control @error('nama_pegawai') is-invalid @enderror"
                               id="nama_pegawai"
                               name="nama_pegawai"
                               value="{{ old('nama_pegawai') }}"
                               placeholder="Masukkan nama pegawai"
                               style="border-color: #BFC9D9;">

                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nip"
                               class="form-label fw-bold"
                               style="color: #0E1A2B;">
                            Nomor Induk Pegawai (NIP)
                        </label>

                        <input type="text"
                               class="form-control @error('nip') is-invalid @enderror"
                               id="nip"
                               name="nip"
                               value="{{ old('nip') }}"
                               placeholder="Contoh: 19950215123"
                               style="border-color: #BFC9D9;">

                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="tanggal"
                                   class="form-label fw-bold"
                                   style="color: #0E1A2B;">
                                Tanggal
                            </label>

                            <input type="date"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   id="tanggal"
                                   name="tanggal"
                                   value="{{ old('tanggal', date('Y-m-d')) }}"
                                   style="border-color: #BFC9D9;">

                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jam_masuk"
                                   class="form-label fw-bold"
                                   style="color: #0E1A2B;">
                                Jam Masuk
                            </label>

                            <input type="time"
                                   class="form-control @error('jam_masuk') is-invalid @enderror"
                                   id="jam_masuk"
                                   name="jam_masuk"
                                   value="{{ old('jam_masuk', date('H:i')) }}"
                                   style="border-color: #BFC9D9;">

                            @error('jam_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="keterangan_kehadiran"
                               class="form-label fw-bold"
                               style="color: #0E1A2B;">
                            Keterangan Kehadiran
                        </label>

                        <select class="form-select @error('keterangan_kehadiran') is-invalid @enderror"
                                id="keterangan_kehadiran"
                                name="keterangan_kehadiran"
                                style="border-color: #BFC9D9;">

                            <option value="" disabled selected>
                                Pilih Keterangan
                            </option>

                            <option value="Hadir"
                                {{ old('keterangan_kehadiran') == 'Hadir' ? 'selected' : '' }}>
                                Hadir
                            </option>

                            <option value="Sakit"
                                {{ old('keterangan_kehadiran') == 'Sakit' ? 'selected' : '' }}>
                                Sakit
                            </option>

                            <option value="Izin"
                                {{ old('keterangan_kehadiran') == 'Izin' ? 'selected' : '' }}>
                                Izin
                            </option>

                            <option value="Dinas Luar"
                                {{ old('keterangan_kehadiran') == 'Dinas Luar' ? 'selected' : '' }}>
                                Dinas Luar
                            </option>

                        </select>

                        @error('keterangan_kehadiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex justify-content-between">

                        <a href="{{ route('attendance.index') }}"
                           class="btn fw-bold"
                           style="background-color: #BFC9D9; color: #0E1A2B;">
                            Kembali
                        </a>

                        <button type="submit"
                                class="btn fw-bold"
                                style="background-color: #425A73; color: white;">
                            Simpan Catatan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection