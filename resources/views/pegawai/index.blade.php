@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Daftar Pegawai</h3>

    <a href="{{ route('pegawai.create') }}" 
class="btn"
style="
background:#041025;
color:white;
">

+ Tambah Data

</a>

</div>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Divisi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($pegawais as $p)
        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $p->nip ?? '-' }}</td>

            <td>{{ $p->nama ?? '-' }}</td>

            <td>{{ $p->jenis_kelamin ?? '-' }}</td>

            <td>{{ $p->jabatan ?? '-' }}</td>

            <td>{{ $p->divisi ?? '-' }}</td>


            <td>

                <a href="{{ route('pegawai.edit', $p->id) }}" 
                class="btn btn-sm"
                style="
                background:#28508D;
                color:white;
                ">
                Edit
                </a>


                <form action="{{ route('pegawai.destroy', $p->id) }}"
                method="POST"
                style="display:inline;"
                onsubmit="return confirm('Yakin hapus data ini?')">

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


</tbody>


</table>


</div>


@endsection