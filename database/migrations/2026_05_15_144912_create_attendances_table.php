<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->string('nip'); // <-- Sudah dihapus ->unique() nya agar bisa absen tiap hari
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_pulang')->nullable();
            $table->enum('keterangan_kehadiran', ['Hadir', 'Sakit', 'Izin', 'Dinas Luar']);
            $table->string('bukti')->nullable(); // <-- INI DIA KAMU YANG KETINGGALAN! (Kolom foto bukti)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};