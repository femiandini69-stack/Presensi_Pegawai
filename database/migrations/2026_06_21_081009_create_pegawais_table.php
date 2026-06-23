<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {

            $table->id();

            // relasi user login
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('nama');

            // NIP
            $table->string('nip')->unique();

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ]);

            // relasi jabatan
            $table->foreignId('jabatan_id')
                  ->constrained('jabatans')
                  ->cascadeOnDelete();


            // relasi divisi
            $table->foreignId('divisi_id')
                  ->constrained('divisis')
                  ->cascadeOnDelete();


            // jam kerja otomatis
            $table->time('jam_masuk')->nullable();

            $table->time('jam_pulang')->nullable();


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }

};