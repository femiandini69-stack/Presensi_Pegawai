<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('approvals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
        $table->enum('jenis', ['izin','cuti','sakit','dinas']);
        $table->integer('jumlah_hari');
        $table->text('alasan');
        $table->enum('status', ['pending','approved','rejected'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
