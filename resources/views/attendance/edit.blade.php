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

                <form action="{{ route('attendance.update', $attendance->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap Pegawai</label>
                        <input type="text"
                               name="nama_pegawai"
                               class="form-control @error('nama_pegawai') is-invalid @enderror"
                               value="{{ old('nama_pegawai', $attendance->nama_pegawai) }}">
                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text"
                               name="nip"
                               class="form-control @error('nip') is-invalid @enderror"
                               value="{{ old('nip', $attendance->nip) }}">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', $attendance->tanggal) }}">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JAM MASUK --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jam Masuk</label>
                        <input type="time"
                               name="jam_masuk"
                               id="jam_masuk"
                               class="form-control @error('jam_masuk') is-invalid @enderror"
                               value="{{ old('jam_masuk', $attendance->jam_masuk ? \Carbon\Carbon::parse($attendance->jam_masuk)->format('H:i') : '') }}">
                        @error('jam_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JAM PULANG --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jam Pulang</label>
                        <input type="time"
                               name="jam_pulang"
                               id="jam_pulang"
                               class="form-control @error('jam_pulang') is-invalid @enderror"
                               value="{{ old('jam_pulang', $attendance->jam_pulang ? \Carbon\Carbon::parse($attendance->jam_pulang)->format('H:i') : '') }}">
                        @error('jam_pulang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STATUS / KETERANGAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan Kehadiran</label>
                        <select name="keterangan_kehadiran"
                                class="form-select @error('keterangan_kehadiran') is-invalid @enderror">
                            <option value="Hadir" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Dinas Luar" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                        </select>
                        @error('keterangan_kehadiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUKTI SEKARANG --}}
                    @if($attendance->bukti)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bukti Saat Ini</label>
                        <div>
                            <img src="{{ asset('bukti/' . $attendance->bukti) }}"
                                 width="200"
                                 class="img-thumbnail">
                        </div>
                    </div>
                    @endif

                    {{-- GANTI BUKTI --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Bukti Kehadiran</label>
                        <input type="file"
                               name="bukti"
                               accept="image/*"
                               class="form-control @error('bukti') is-invalid @enderror">
                        @error('bukti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TOMBOL --}}
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('attendance.index') }}"
                           class="btn fw-bold"
                           style="background-color:#BFC9D9;">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const jamMasuk = document.getElementById('jam_masuk');
    const jamPulang = document.getElementById('jam_pulang');

    if (jamMasuk && jamPulang) {
        function hitungJamPulang() {
            // Jalankan otomatis kalkulasi HANYA jika jam pulang belum terisi / kosong semula
            if (jamMasuk.value && !jamPulang.value) {
                let [jam, menit] = jamMasuk.value.split(':').map(Number);
                let date = new Date();
                date.setHours((jam + 8) % 24);
                date.setMinutes(menit);

                let hasil =
                    String(date.getHours()).padStart(2, '0') + ':' +
                    String(date.getMinutes()).padStart(2, '0');

                jamPulang.value = hasil;
            }
        }

        jamMasuk.addEventListener('input', function() {
            // Jika user sengaja mengubah jam masuk, kosongkan dulu jam pulang lama agar terhitung baru
            jamPulang.value = '';
            hitungJamPulang();
        });
    }
});
</script>

@endsection