@extends('layouts.app') 

@section('content')
<div class="container">
    <h3>Log Presensi</h3>
    
    <a href="{{ route('pegawai.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">
        + Tambah Pegawai Baru
    </a>

    <hr>

    <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
        </form>

    <table>
        </table>
</div>
@endsection