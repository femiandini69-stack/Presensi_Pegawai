@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

```
    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header py-3 border-0 rounded-top-4"
             style="background-color:#E6EEF6;">

            <h5 class="m-0 fw-bold" style="color:#425A73;">
                Edit Catatan Presensi Pegawai
            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('attendance.update', $attendance->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Nama Lengkap Pegawai
                    </label>

                    <input type="text"
                           name="nama_pegawai"
                           class="form-control @error('nama_pegawai') is-invalid @enderror"
                           value="{{ old('nama_pegawai', $attendance->nama_pegawai) }}">

                    @error('nama_pegawai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        NIP
                    </label>

                    <input type="text"
                           name="nip"
                           class="form-control @error('nip') is-invalid @enderror"
                           value="{{ old('nip', $attendance->nip) }}">

                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Tanggal
                    </label>

                    <input type="date"
                           name="tanggal"
                           class="form-control @error('tanggal') is-invalid @enderror"
                           value="{{ old('tanggal', $attendance->tanggal) }}">

                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Jam Masuk
                    </label>

                    <input type="time"
                           name="jam_masuk"
                           class="form-control @error('jam_masuk') is-invalid @enderror"
                           value="{{ old('jam_masuk', $attendance->jam_masuk) }}">

                    @error('jam_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Keterangan Kehadiran
                    </label>

                    <select name="keterangan_kehadiran"
                            class="form-select @error('keterangan_kehadiran') is-invalid @enderror">

                        <option value="Hadir" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Hadir' ? 'selected' : '' }}>
                            Hadir
                        </option>

                        <option value="Sakit" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Sakit' ? 'selected' : '' }}>
                            Sakit
                        </option>

                        <option value="Izin" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Izin' ? 'selected' : '' }}>
                            Izin
                        </option>

                        <option value="Dinas Luar" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Dinas Luar' ? 'selected' : '' }}>
                            Dinas Luar
                        </option>

                    </select>

                    @error('keterangan_kehadiran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($attendance->bukti)
                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Bukti Saat Ini
                    </label>

                    <div>
                        <img src="{{ asset('bukti/' . $attendance->bukti) }}"
                             alt="Bukti Presensi"
                             width="200"
                             class="img-thumbnail">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Ganti Bukti Kehadiran
                    </label>

                    <input type="file"
                           name="bukti"
                           accept="image/*"
                           class="form-control @error('bukti') is-invalid @enderror">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                    </small>

                    @error('bukti')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
```

</div>

@endsection
