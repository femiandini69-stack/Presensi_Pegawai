<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPresensiSeeder extends Seeder {
    public function run(): void {
        $statuses = ['Hadir', 'Sakit', 'Izin', 'Dinas Luar'];
        foreach ($statuses as $s) {
            DB::table('status_presensis')->insert(['nama_status' => $s, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
