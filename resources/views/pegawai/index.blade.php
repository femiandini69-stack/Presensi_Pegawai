@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Daftar Pegawai</h3>

    <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
        + Tambah Data
    </a>

</div>

    <table class="table table-bordered">
        <thead>
            <tr>
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
                <td>{{ $p->nip ?? '-' }}</td>
                <td>{{ $p->nama ?? '-' }}</td>
                <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                <td>{{ $p->jabatan ?? '-' }}</td>
                <td>{{ $p->divisi ?? '-' }}</td>

                <td>
                    <a href="{{ route('pegawai.edit', $p->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('pegawai.destroy', $p->id) }}"
                          method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('Yakin hapus data ini?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
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