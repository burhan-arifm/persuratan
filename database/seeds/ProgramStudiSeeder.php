<?php

use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bimbingan dan Konseling Islam
        DB::table('program_studis')->insert([
            'kode_program_studi' => '401',
            'singkatan_program_studi' => 'BKI',
            'nama_program_studi' => 'Bimbingan dan Konseling Islam',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Komunikasi dan Penyiaran Islam
        DB::table('program_studis')->insert([
            'kode_program_studi' => '402',
            'singkatan_program_studi' => 'KPI',
            'program_studi' => 'Komunikasi dan Penyiaran Islam',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Manajemen Dakwah
        DB::table('program_studis')->insert([
            'kode_program_studi' => '403',
            'singkatan_program_studi' => 'MD',
            'program_studi' => 'Manajemen Dakwah',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Pengembangan Masyarakat Islam
        DB::table('program_studis')->insert([
            'kode_program_studi' => '404',
            'singkatan_program_studi' => 'PMI',
            'program_studi' => 'Pengembangan Masyarakat Islam',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        DB::table('program_studis')->insert([
            'kode_program_studi' => '405',
            'singkatan_program_studi' => 'JUR',
            'program_studi' => 'Ilmu Komunikasi Bidang Jurnalistik',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        DB::table('program_studis')->insert([
            'kode_program_studi' => '406',
            'singkatan_program_studi' => 'HUM',
            'program_studi' => 'Ilmu Komunikasi Bidang Humas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
