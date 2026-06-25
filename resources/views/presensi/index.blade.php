@extends('layouts.app')

@section('content')

<div class="container-fluid">


<h3 class="mb-3">
Log Presensi
</h3>


{{-- FILTER --}}
<div class="card shadow-sm mb-3">

<div class="card-body p-3">


<h6 class="mb-3">
FILTER PENCARIAN
</h6>


<form method="GET" action="{{ route('presensi.index') }}">


<div class="row g-2">


<div class="col-md-4">

<label class="small">
Nama / NIP
</label>

<input type="text"
name="search"
value="{{request('search')}}"
class="form-control"
placeholder="Ketik nama atau NIP">

</div>




<div class="col-md-3">

<label class="small">
Status
</label>


<select name="status"
class="form-control">


<option value="">
Pilih Status
</option>


@foreach([
'Hadir',
'Izin',
'Sakit',
'Dinas Luar',
'Cuti',
'Alpha'
] as $status)


<option value="{{$status}}"
@if(request('status')==$status)
selected
@endif>

{{$status}}

</option>


@endforeach


</select>


</div>





<div class="col-md-2 d-flex align-items-end">


<button class="btn btn-sm"
style="
background:#132D55;
color:white;
">

Cari

</button>



<a href="{{route('presensi.index')}}"

class="btn btn-secondary btn-sm ms-2">

Reset

</a>


</div>


</div>


</form>


</div>

</div>





{{-- REKAP --}}

<div class="row g-2 mb-3">


@php

$cards=[

['Hadir','#13d255'],
['Sakit','#dc3545'],
['Izin','#ffc107'],
['Dinas Luar','#0d6efd'],
['Cuti','#3baed8'],
['Alpha','#212529']

];

@endphp



@foreach($cards as $c)


<div class="col-md-2">


<div class="card shadow-sm p-2"

style="
background:{{$c[1]}};
color:white;
height:80px;
">


<h6 class="mb-1">
{{$c[0]}}
</h6>


<h4 class="mb-0">

{{ $presensi->where('status',$c[0])->count() }}

</h4>


</div>


</div>


@endforeach



</div>





<a href="{{route('presensi.create')}}"

class="btn btn-sm mb-3"

style="
background:#041025;
color:white;
">

+ Tambah Presensi

</a>





<table class="table table-bordered table-sm">


<thead class="table-light">


<tr>

<th>No</th>
<th>Nama</th>
<th>NIP</th>
<th>Jabatan</th>
<th>Divisi</th>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Status</th>
<th>Bukti</th>
<th>Aksi</th>


</tr>


</thead>




<tbody>


@foreach($presensi as $i=>$d)


<tr>


<td>
{{$i+1}}
</td>


<td>
{{$d->nama}}
</td>


<td>
{{$d->nip}}
</td>


<td>
{{$d->jabatan}}
</td>


<td>
{{$d->divisi}}
</td>


<td>
{{$d->tanggal}}
</td>


<td>
{{$d->jam_masuk}}
</td>


<td>
{{$d->jam_pulang}}
</td>




<td>


<span class="badge

@if($d->status=='Hadir')
bg-success

@elseif($d->status=='Sakit')
bg-danger

@elseif($d->status=='Izin')
bg-warning text-dark

@elseif($d->status=='Dinas Luar')
bg-primary

@elseif($d->status=='Cuti')
bg-info

@else
bg-dark

@endif

">

{{$d->status}}

</span>


</td>





<td>


@if($d->bukti)

<img src="{{asset('storage/'.$d->bukti)}}"
width="45"
class="rounded">

@endif


</td>





<td>


<a href="{{route('presensi.edit',$d->id)}}"

class="btn btn-sm"

style="
background:#28508D;
color:white;
">

Edit

</a>




<form action="{{route('presensi.destroy',$d->id)}}"

method="POST"

style="display:inline"

onsubmit="return confirm('Anda yakin menghapus data ini?')">


@csrf
@method('DELETE')


<button class="btn btn-sm"

style="
background:#3C66A7;
color:white;
">

Hapus

</button>


</form>


</td>



</tr>


@endforeach


</tbody>


</table>


</div>


@endsection