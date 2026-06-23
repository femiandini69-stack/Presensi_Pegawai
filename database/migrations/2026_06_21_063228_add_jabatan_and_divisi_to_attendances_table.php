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
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('jabatan')->nullable(); // Menambahkan kolom jabatan
            $table->string('divisi')->nullable();  // Menambahkan kolom divisi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Kita harus menghapus kolom yang tadi dibuat jika melakukan rollback
            $table->dropColumn(['jabatan', 'divisi']);
        });
    }
};