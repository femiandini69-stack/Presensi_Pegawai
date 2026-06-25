@extends('layouts.app')


@section('content')

<div class="container">


<h3>Tambah Presensi</h3>


<form method="POST"
action="{{route('presensi.store')}}"
enctype="multipart/form-data">

@csrf



<label>Pegawai</label>

<select name="pegawai_id"
id="pegawai"
class="form-control mb-3">


<option value="">
Pilih Pegawai
</option>


@foreach($pegawai as $p)

<option 
value="{{$p->id}}"

data-nip="{{$p->nip}}"

data-jabatan="{{$p->jabatan}}"

data-divisi="{{$p->divisi}}"

>

{{$p->nama}}

</option>


@endforeach


</select>




<input class="form-control mb-2"
id="nip"
placeholder="NIP"
readonly>


<input class="form-control mb-2"
id="jabatan"
placeholder="Jabatan"
readonly>


<input class="form-control mb-2"
id="divisi"
placeholder="Divisi"
readonly>




<label>Tanggal</label>

<input type="date"
name="tanggal"
class="form-control mb-3"
value="{{date('Y-m-d')}}">



<div class="row">

<div class="col-md-6">

<label>Jam Masuk</label>

<input type="time"
id="jam_masuk"
name="jam_masuk"
class="form-control"
value="{{date('H:i')}}"
required>

</div>


<div class="col-md-6">

<label>Jam Pulang</label>

<input type="time"
id="jam_pulang"
name="jam_pulang"
class="form-control"
readonly>

</div>


</div>

<script>

document.getElementById('jam_masuk')
.addEventListener('change',function(){


let masuk = this.value;


let waktu = new Date(
'2026-01-01 '+masuk
);


waktu.setHours(
waktu.getHours()+8
);



let jam =
String(waktu.getHours())
.padStart(2,'0');


let menit =
String(waktu.getMinutes())
.padStart(2,'0');



document.getElementById('jam_pulang')
.value =
jam+":"+menit;


});



</script>


<label>Status</label>

<select name="status"
class="form-control mt-3">


<option>Hadir</option>
<option>Izin</option>
<option>Sakit</option>
<option>Dinas Luar</option>
<option>Cuti</option>
<option>Alpha</option>


</select>


<label class="mt-3">
Upload Foto
</label>

<input type="file"
name="bukti"
class="form-control">


<br>


<button class="btn btn-primary">
Simpan
</button>


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