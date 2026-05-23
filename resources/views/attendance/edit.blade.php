@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header py-3 border-0 rounded-top-4"
                 style="background-color:#E6EEF6;">

                <h5 class="m-0 fw-bold" style="color:#425A73;">
                    Edit Catatan Presensi Pegawai
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Nama Lengkap Pegawai
                        </label>

                        <input type="text"
                               class="form-control @error('nama_pegawai') is-invalid @enderror"
                               name="nama_pegawai"
                               value="{{ old('nama_pegawai', $attendance->nama_pegawai) }}">

                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP (TAMBAHAN PENTING) --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            NIP
                        </label>

                        <input type="text"
                               class="form-control @error('nip') is-invalid @enderror"
                               name="nip"
                               value="{{ old('nip', $attendance->nip) }}">

                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Tanggal
                        </label>

                        <input type="date"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               name="tanggal"
                               value="{{ old('tanggal', $attendance->tanggal) }}">

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JAM --}}
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#0E1A2B;">
                                Jam Masuk
                            </label>

                            <input type="time"
                                   class="form-control"
                                   name="jam_masuk"
                                   value="{{ old('jam_masuk', $attendance->jam_masuk) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#0E1A2B;">
                                Jam Pulang
                            </label>

                            <input type="time"
                                   class="form-control"
                                   name="jam_pulang"
                                   value="{{ old('jam_pulang', $attendance->jam_pulang) }}">
                        </div>

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#0E1A2B;">
                            Keterangan
                        </label>

                        <select class="form-select" name="keterangan_kehadiran">

                            <option value="Hadir" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Hadir' ? 'selected' : '' }}>Hadir</option>

                            <option value="Sakit" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Sakit' ? 'selected' : '' }}>Sakit</option>

                            <option value="Izin" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Izin' ? 'selected' : '' }}>Izin</option>

                            <option value="Dinas Luar" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>

                        </select>
                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-4 d-flex justify-content-between">

                        <a href="{{ route('attendance.index') }}"
                           class="btn fw-bold"
                           style="background-color:#BFC9D9; color:#0E1A2B;">
                            Batal
                        </a>

                        <button type="submit"
                                class="btn fw-bold"
                                style="background-color:#3d6780; color:white;">
                            Perbarui Data
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection