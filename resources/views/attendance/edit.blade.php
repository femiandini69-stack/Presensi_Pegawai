@extends('layouts.app')

@section('content')

<style>
.card {
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}

.form-control,
.form-select {
    border-radius: 8px;
}

.btn-save {
    background:#3d6780;
    color:white;
    border-radius:8px;
}

.btn-cancel {
    background:#BFC9D9;
    border-radius:8px;
}
</style>


<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">


<div class="card border-0">

<div class="card-header">
    <h5 class="fw-bold mb-0">
        Edit Catatan Presensi Pegawai
    </h5>
</div>


<div class="card-body">


<form action="{{ route('attendance.update',$attendance->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')


<input type="hidden"
       name="pegawai_id"
       value="{{ $attendance->pegawai_id }}">



<div class="row">

<div class="col-md-6 mb-3">
<label class="fw-bold">Nama Lengkap</label>

<input type="text"
       class="form-control"
       value="{{ $attendance->pegawai->nama ?? '-' }}"
       readonly>
</div>


<div class="col-md-6 mb-3">
<label class="fw-bold">NIP</label>

<input type="text"
       class="form-control"
       value="{{ $attendance->pegawai->nip ?? '-' }}"
       readonly>
</div>

</div>



<div class="row">

<div class="col-md-6 mb-3">
<label class="fw-bold">Jabatan</label>

<input type="text"
       class="form-control"
       value="{{ $attendance->pegawai->jabatan ?? '-' }}"
       readonly>
</div>


<div class="col-md-6 mb-3">
<label class="fw-bold">Divisi</label>

<input type="text"
       class="form-control"
       value="{{ $attendance->pegawai->divisi ?? '-' }}"
       readonly>
</div>

</div>



<div class="mb-3">

<label class="fw-bold">
Tanggal
</label>

<input type="date"
       name="tanggal"
       class="form-control"
       value="{{ $attendance->tanggal }}"
       required>

</div>



<div class="row">

<div class="col-md-6 mb-3">

<label class="fw-bold">
Jam Masuk
</label>

<input type="time"
       name="jam_masuk"
       class="form-control"
       value="{{ \Carbon\Carbon::parse($attendance->jam_masuk)->format('H:i') }}"
       required>

</div>



<div class="col-md-6 mb-3">

<label class="fw-bold">
Jam Pulang
</label>

<input type="time"
       class="form-control"
       value="{{ \Carbon\Carbon::parse($attendance->jam_pulang)->format('H:i') }}"
       readonly>

</div>

</div>




<div class="mb-3">

<label class="fw-bold">
Keterangan Kehadiran
</label>

<select name="keterangan_kehadiran"
        class="form-select">


@foreach(['Hadir','Sakit','Izin','Dinas Luar','Cuti','Alpha'] as $status)

<option value="{{ $status }}"
{{ $attendance->keterangan_kehadiran == $status ? 'selected':'' }}>

{{ $status }}

</option>

@endforeach


</select>

</div>




<div class="mb-3">

<label class="fw-bold">
Ganti Bukti Kehadiran
</label>

<input type="file"
       name="bukti"
       class="form-control">

</div>




<div class="text-end">

<a href="{{ route('attendance.index') }}"
   class="btn btn-cancel">

Batal

</a>


<button class="btn btn-save">
Perbarui Data
</button>


</div>


</form>


</div>

</div>


</div>

</div>

</div>


@endsection