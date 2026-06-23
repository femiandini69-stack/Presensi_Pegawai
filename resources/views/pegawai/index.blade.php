@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Daftar Pegawai</h3>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">+ Tambah Pegawai</a>
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
                <td>{{ $p->name ?? '-' }}</td>
                <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                
                <td>{{ is_object($p->jabatan) ? ($p->jabatan->nama_jabatan ?? '-') : ($p->jabatan ?? '-') }}</td>
                <td>{{ $p->divisi ?? '-' }}</td>
                
                <td>
                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection