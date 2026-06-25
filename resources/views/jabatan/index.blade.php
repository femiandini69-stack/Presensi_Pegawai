@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="mb-3">Tambah Jabatan</h5>
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Nama Jabatan</label>
                        <select name="nama_jabatan" class="form-control" required>
                            <option value="Direktur">Direktur</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Team Leader">Team Leader</option>
                            <option value="Staff">Staff</option>
                            <option value="Intern">Intern (Magang)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="mb-3">Daftar Jabatan</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_jabatan }}</td>
                            <td>
   <a href="{{ route('jabatan.edit', $item->id) }}" 
   style="background-color: #2F456E; color: white; border: none; padding: 5px 8px; font-size: 12px; border-radius: 3px; text-decoration: none; margin-right: 5px;">
   Edit
</a>

<form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" 
            style="background-color: #54668D; color: white; border: none; padding: 5px 8px; font-size: 12px; border-radius: 3px; cursor: pointer;"
            onclick="return confirm('Yakin ingin menghapus jabatan ini?')">
            Hapus
    </button>
</form>
</td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection