@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Data Pegawai</h3>

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control"
                   value="{{ $pegawai->nip }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $pegawai->name }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" class="form-control"
                   value="{{ $pegawai->jenis_kelamin }}">
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control"
                   value="{{ $pegawai->jabatan }}">
        </div>

        <div class="mb-3">
            <label>Divisi</label>
            <input type="text" name="divisi" class="form-control"
                   value="{{ $pegawai->divisi }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
@endsection