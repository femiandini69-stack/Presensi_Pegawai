@extends('layouts.app')


@section('content')

<div class="container">


<h3>Edit Presensi</h3>



<form method="POST"
action="{{route('presensi.update',$presensi->id)}}"
enctype="multipart/form-data">


@csrf

@method('PUT')



<label>Pegawai</label>


<select name="pegawai_id"
id="pegawai"
class="form-control mb-3">


@foreach($pegawai as $p)


<option 
value="{{$p->id}}"

data-nip="{{$p->nip}}"

data-jabatan="{{$p->jabatan}}"

data-divisi="{{$p->divisi}}"


@if($p->id == $presensi->pegawai_id)

selected

@endif


>


{{$p->nama}}

</option>


@endforeach



</select>





<label>NIP</label>

<input type="text"
id="nip"
class="form-control mb-2"
value="{{$presensi->nip}}"
readonly>





<label>Jabatan</label>

<input type="text"
id="jabatan"
class="form-control mb-2"
value="{{$presensi->jabatan}}"
readonly>





<label>Divisi</label>

<input type="text"
id="divisi"
class="form-control mb-3"
value="{{$presensi->divisi}}"
readonly>






<label>Tanggal</label>

<input type="date"
name="tanggal"
class="form-control mb-3"

value="{{$presensi->tanggal}}"

>






<div class="row">


<div class="col">


<label>Jam Masuk</label>


<input type="time"

class="form-control"

value="{{$presensi->jam_masuk}}"

readonly>


</div>



<div class="col">


<label>Jam Pulang</label>


<input type="time"

class="form-control"

value="{{$presensi->jam_pulang}}"

readonly>


</div>



</div>







<label class="mt-3">
Status Kehadiran
</label>



<select name="status"

class="form-control mb-3">



<option

{{ $presensi->status=='Hadir'?'selected':'' }}

>

Hadir

</option>



<option

{{ $presensi->status=='Izin'?'selected':'' }}

>

Izin

</option>




<option

{{ $presensi->status=='Sakit'?'selected':'' }}

>

Sakit

</option>




<option

{{ $presensi->status=='Dinas Luar'?'selected':'' }}

>

Dinas Luar

</option>




<option

{{ $presensi->status=='Cuti'?'selected':'' }}

>

Cuti

</option>




<option

{{ $presensi->status=='Alpha'?'selected':'' }}

>

Alpha

</option>



</select>













<label>
Bukti Saat Ini
</label>

<br>


@if($presensi->bukti)


<img src="{{asset('storage/'.$presensi->bukti)}}"

width="100"

class="mb-3">


@endif






<label>
Ganti Foto (Opsional)
</label>


<input type="file"

name="bukti"

class="form-control mb-3">



<small>
JPG / JPEG / PNG Maksimal 5 MB
</small>




<br><br>



<button class="btn btn-success">

Perbarui Data

</button>



<a href="{{route('presensi.index')}}"

class="btn btn-secondary">

Batal

</a>




</form>


</div>






<script>


document
.getElementById('pegawai')
.onchange=function(){


let data =
this.options[this.selectedIndex];



document.getElementById('nip').value =
data.dataset.nip;



document.getElementById('jabatan').value =
data.dataset.jabatan;



document.getElementById('divisi').value =
data.dataset.divisi;



}



</script>




@endsection