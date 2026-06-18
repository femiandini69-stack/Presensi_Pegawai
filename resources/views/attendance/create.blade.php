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

                <form action="{{ route('attendance.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Nama Lengkap Pegawai
                        </label>

                        <input type="text"
                               class="form-control @error('nama_pegawai') is-invalid @enderror"
                               name="nama_pegawai"
                               value="{{ old('nama_pegawai') }}"
                               placeholder="Masukkan nama pegawai">

                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            NIP
                        </label>

                        <input type="text"
                               class="form-control @error('nip') is-invalid @enderror"
                               name="nip"
                               value="{{ old('nip') }}"
                               placeholder="Contoh: 19950215123">

                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        {{-- TANGGAL --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#0E1A2B;">
                                Tanggal
                            </label>

                            <input type="date"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   name="tanggal"
                                   value="{{ old('tanggal', date('Y-m-d')) }}">

                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- JAM MASUK --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#0E1A2B;">
                                Jam Masuk
                            </label>

                            <input type="time"
                                   class="form-control @error('jam_masuk') is-invalid @enderror"
                                   name="jam_masuk"
                                   value="{{ old('jam_masuk', date('H:i')) }}">

                            @error('jam_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Keterangan Kehadiran
                        </label>

                        <select class="form-select @error('keterangan_kehadiran') is-invalid @enderror"
                                name="keterangan_kehadiran">

                            <option value="" disabled selected>
                                Pilih Keterangan
                            </option>

                            <option value="Hadir" {{ old('keterangan_kehadiran') == 'Hadir' ? 'selected' : '' }}>
                                Hadir
                            </option>

                            <option value="Sakit" {{ old('keterangan_kehadiran') == 'Sakit' ? 'selected' : '' }}>
                                Sakit
                            </option>

                            <option value="Izin" {{ old('keterangan_kehadiran') == 'Izin' ? 'selected' : '' }}>
                                Izin
                            </option>

                            <option value="Dinas Luar" {{ old('keterangan_kehadiran') == 'Dinas Luar' ? 'selected' : '' }}>
                                Dinas Luar
                            </option>

                        </select>

                        @error('keterangan_kehadiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUKTI FOTO --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Bukti Kehadiran
                        </label>

                        <input type="file"
                               name="bukti"
                               accept="image/*"
                               class="form-control @error('bukti') is-invalid @enderror">

                        <small class="text-muted">
                            Upload foto bukti kehadiran (jpg, jpeg, png).
                        </small>

                        @error('bukti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-4 d-flex justify-content-between">

                        <a href="{{ route('attendance.index') }}"
                           class="btn fw-bold"
                           style="background-color:#BFC9D9; color:#0E1A2B;">
                            Kembali
                        </a>

                        <button type="submit"
                                class="btn fw-bold"
                                style="background-color:#425A73; color:white;">
                            Simpan Catatan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection

