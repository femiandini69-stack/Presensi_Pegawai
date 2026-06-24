@extends('layouts.app')

@section('content')
<div class="container">

<h3>Log Presensi Real-Time</h3>

<a href="{{ route('presensi.create') }}" class="btn btn-primary mb-3">
+ Tambah Presensi
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Jabatan</th>
            <th>Divisi</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($presensi as $i => $d)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->nip }}</td>
            <td>{{ $d->jabatan }}</td>
            <td>{{ $d->divisi }}</td>
            <td>{{ $d->tanggal }}</td>
            <td>{{ $d->jam_masuk }}</td>
            <td>{{ $d->jam_pulang }}</td>
            <td>
                <span class="badge bg-info">{{ $d->status }}</span>
            </td>
            <td>
                @if($d->foto)
                    <img src="{{ asset('uploads/'.$d->foto) }}" width="50">
                @endif
            </td>
            <td>
                <a href="{{ route('presensi.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('presensi.destroy',$d->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

</div>
@endsection