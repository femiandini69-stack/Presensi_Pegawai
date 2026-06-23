@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Jabatan</h3>
    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" value="{{ $jabatan->nama_jabatan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection