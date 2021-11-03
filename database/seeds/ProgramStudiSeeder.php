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
            'kode_prodi' => 'BKI',
            'program_studi' => 'Bimbingan dan Konseling Islam'
        ]);
        // Komunikasi dan Penyiaran Islam
        DB::table('program_studis')->insert([
            'kode_prodi' => 'KPI',
            'program_studi' => 'Komunikasi dan Penyiaran Islam'
        ]);
        // Manajemen Dakwah
        DB::table('program_studis')->insert([
            'kode_prodi' => 'MD',
            'program_studi' => 'Manajemen Dakwah'
        ]);
        // Pengembangan Masyarakat Islam
        DB::table('program_studis')->insert([
            'kode_prodi' => 'PMI',
            'program_studi' => 'Pengembangan Masyarakat Islam'
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        DB::table('program_studis')->insert([
            'kode_prodi' => 'JUR',
            'program_studi' => 'Ilmu Komunikasi Bidang Jurnalistik'
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        DB::table('program_studis')->insert([
            'kode_prodi' => 'HUM',
            'program_studi' => 'Ilmu Komunikasi Bidang Humas'
        ]);
    }
}
