<form method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
@csrf

<input name="nama" placeholder="Nama" class="form-control mb-2">
<input name="nip" placeholder="NIP" class="form-control mb-2">
<input name="jabatan" placeholder="Jabatan" class="form-control mb-2">
<input name="divisi" placeholder="Divisi" class="form-control mb-2">

<select name="status" class="form-control mb-2">
    <option>Hadir</option>
    <option>Izin</option>
    <option>Sakit</option>
    <option>Dinas Luar</option>
    <option>Cuti</option>
    <option>Alpha</option>
</select>

<input type="file" name="foto" class="form-control mb-2">

<button class="btn btn-success">Simpan</button>
</form>