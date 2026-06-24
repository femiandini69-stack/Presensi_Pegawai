<form method="POST" action="{{ route('presensi.update',$data->id) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<input name="nama" value="{{ $data->nama }}" class="form-control mb-2">
<input name="nip" value="{{ $data->nip }}" class="form-control mb-2">
<input name="jabatan" value="{{ $data->jabatan }}" class="form-control mb-2">
<input name="divisi" value="{{ $data->divisi }}" class="form-control mb-2">

<select name="status" class="form-control mb-2">
    <option {{ $data->status=='Hadir'?'selected':'' }}>Hadir</option>
    <option {{ $data->status=='Izin'?'selected':'' }}>Izin</option>
    <option {{ $data->status=='Sakit'?'selected':'' }}>Sakit</option>
    <option {{ $data->status=='Dinas Luar'?'selected':'' }}>Dinas Luar</option>
    <option {{ $data->status=='Cuti'?'selected':'' }}>Cuti</option>
    <option {{ $data->status=='Alpha'?'selected':'' }}>Alpha</option>
</select>

<input type="file" name="foto" class="form-control mb-2">

<button class="btn btn-primary">Update</button>
</form>