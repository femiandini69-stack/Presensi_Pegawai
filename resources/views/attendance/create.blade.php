@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header">
                <h5 class="mb-0">Formulir Presensi Pegawai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- NO, NAMA, NIP --}}
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>No</label>
                            <input type="text" id="no_display" class="form-control" readonly>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label>Nama</label>
                            <select name="pegawai_id" id="pegawai_select" class="form-control" required onchange="updatePegawaiData()">
                                <option value="">-- Pilih Nama --</option>
                                @foreach($pegawais as $index => $p)
                                    <option value="{{ $p->id }}" data-nip="{{ $p->nip }}" data-no="{{ $index + 1 }}">
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label>NIP</label>
                            <input type="text" id="nip_display" class="form-control" readonly>
                        </div>
                    </div>

                    {{-- JABATAN & DIVISI --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Direktur">Direktur</option>
                                <option value="Manager">Manager</option>
                                <option value="Team Leader">Team Leader</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Staff">Staff</option>
                                <option value="Intern (Magang)">Intern (Magang)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Divisi</label>
                            <select name="divisi" class="form-control" required>
                                <option value="">-- Pilih Divisi --</option>
                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Research and Development">Research and Development</option>
                            </select>
                        </div>
                    </div>

                    {{-- JAM KERJA --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jam Masuk</label>
                            <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" required onchange="hitungJamPulang()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jam Pulang</label>
                            <input type="time" name="jam_pulang" id="jam_pulang" class="form-control" readonly>
                        </div>
                    </div>

                    {{-- KETERANGAN & BUKTI --}}
                    <div class="mb-3">
                        <label>Keterangan Kehadiran</label>
                        <select name="keterangan_kehadiran" class="form-control" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Dinas Luar">Dinas Luar</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Bukti Kehadiran</label>
                        <input type="file" name="bukti" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Presensi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Update No dan NIP otomatis
    function updatePegawaiData() {
        let select = document.getElementById('pegawai_select');
        let selectedOption = select.options[select.selectedIndex];
        document.getElementById('no_display').value = selectedOption.getAttribute('data-no');
        document.getElementById('nip_display').value = selectedOption.getAttribute('data-nip');
    }

    // Hitung Jam Pulang (Masuk + 8 Jam)
    function hitungJamPulang() {
        let jamMasuk = document.getElementById('jam_masuk').value;
        if (jamMasuk) {
            let [hours, minutes] = jamMasuk.split(':');
            let date = new Date();
            date.setHours(parseInt(hours) + 8);
            date.setMinutes(parseInt(minutes));
            
            let h = String(date.getHours()).padStart(2, '0');
            let m = String(date.getMinutes()).padStart(2, '0');
            document.getElementById('jam_pulang').value = `${h}:${m}`;
        }
    }
</script>
@endsection