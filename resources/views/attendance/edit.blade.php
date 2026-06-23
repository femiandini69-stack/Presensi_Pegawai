@extends('layouts.app')

@section('content')
<style>

    .card { border-radius: 15px !important; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .card-header { background-color: #f8f9fa !important; border-bottom: 1px solid #e9ecef; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #ced4da; padding: 10px; }
    .btn-save { background-color: #3d6780; color: white; border-radius: 8px; padding: 10px 25px; }
    .btn-cancel { background-color: #BFC9D9; border-radius: 8px; padding: 10px 25px; }
</style>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0">
            <div class="card-header py-3">
                <h5 class="m-0 fw-bold" style="color:#425A73;">Edit Catatan Presensi Pegawai</h5>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $attendance->nama_pegawai) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip', $attendance->nip) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jabatan</label>
                            <select name="jabatan" class="form-select" required>
                                <option value="Direktur" {{ old('jabatan', $attendance->jabatan) == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                                <option value="Manager" {{ old('jabatan', $attendance->jabatan) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Staff" {{ old('jabatan', $attendance->jabatan) == 'Staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Divisi</label>
                            <select name="divisi" class="form-select" required>
                                <option value="Teknologi Informasi" {{ old('divisi', $attendance->divisi) == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                                <option value="Finance" {{ old('divisi', $attendance->divisi) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="HRD" {{ old('divisi', $attendance->divisi) == 'HRD' ? 'selected' : '' }}>HRD</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $attendance->tanggal) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Masuk</label>
                            <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" value="{{ old('jam_masuk', $attendance->jam_masuk ? \Carbon\Carbon::parse($attendance->jam_masuk)->format('H:i') : '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam Pulang</label>
                            <input type="time" name="jam_pulang" id="jam_pulang" class="form-control" value="{{ old('jam_pulang', $attendance->jam_pulang ? \Carbon\Carbon::parse($attendance->jam_pulang)->format('H:i') : '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan Kehadiran</label>
                        <select name="keterangan_kehadiran" class="form-select">
                            @foreach(['Hadir', 'Sakit', 'Izin', 'Dinas Luar', 'Cuti', 'Alpha'] as $status)
                                <option value="{{ $status }}" {{ old('keterangan_kehadiran', $attendance->keterangan_kehadiran) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Bukti Kehadiran</label>
                        <input type="file" name="bukti" class="form-control" accept="image/*">
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('attendance.index') }}" class="btn btn-cancel text-dark fw-bold">Batal</a>
                        <button type="submit" class="btn btn-save fw-bold">Perbarui Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection