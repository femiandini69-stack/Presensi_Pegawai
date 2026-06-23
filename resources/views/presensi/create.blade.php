<form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="pegawai_id" value="{{ auth()->user()->id }}">
    
    <select name="status" required>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
    </select>
    
    <input type="file" name="bukti" accept="image/*" required>
    <textarea name="keterangan" placeholder="Keterangan (jika ada)"></textarea>
    
    <button type="submit">Submit Presensi</button>
</form>