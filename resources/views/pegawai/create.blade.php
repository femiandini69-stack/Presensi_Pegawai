@extends('layouts.app')

@section('content')
<div class="container">

<h3>Tambah Pegawai</h3>

<form action="{{ route('pegawai.store') }}" method="POST">
@csrf

<!-- NAMA -->
<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
</div>

<!-- NIP -->
<div class="mb-3">
    <label>NIP</label>
    <input type="text" name="nip" class="form-control" required>
</div>

<!-- JENIS KELAMIN -->
<div class="mb-3">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
</div>

<!-- JABATAN -->
<div class="mb-3">
    <label>Jabatan</label>
    <select name="jabatan" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Direktur">Direktur</option>
        <option value="Manager">Manager</option>
        <option value="Supervisor">Supervisor</option>
        <option value="Team Leader">Team Leader</option>
        <option value="Staff">Staff</option>
        <option value="Intern (Magang)">Intern (Magang)</option>
    </select>
</div>

<!-- DIVISI -->
<div class="mb-3">
    <label>Divisi</label>
    <select name="divisi" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Teknologi Informasi">Teknologi Informasi</option>
        <option value="Finance">Finance</option>
        <option value="Marketing">Marketing</option>
        <option value="Quality Assurance">Quality Assurance</option>
        <option value="Research and Development">Research and Development</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">
    Simpan
</button>

</form>

</div>
@endsection