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
        \App\ProgramStudi::create([
            'kode_program_studi' => '401',
            'singkatan_program_studi' => 'BKI',
            'nama_program_studi' => 'Bimbingan dan Konseling Islam'
        ]);
        // Komunikasi dan Penyiaran Islam
        \App\ProgramStudi::create([
            'kode_program_studi' => '402',
            'singkatan_program_studi' => 'KPI',
            'nama_program_studi' => 'Komunikasi dan Penyiaran Islam'
        ]);
        // Manajemen Dakwah
        \App\ProgramStudi::create([
            'kode_program_studi' => '403',
            'singkatan_program_studi' => 'MD',
            'nama_program_studi' => 'Manajemen Dakwah'
        ]);
        // Pengembangan Masyarakat Islam
        \App\ProgramStudi::create([
            'kode_program_studi' => '404',
            'singkatan_program_studi' => 'PMI',
            'nama_program_studi' => 'Pengembangan Masyarakat Islam'
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        \App\ProgramStudi::create([
            'kode_program_studi' => '405',
            'singkatan_program_studi' => 'JUR',
            'nama_program_studi' => 'Ilmu Komunikasi Bidang Jurnalistik'
        ]);
        // Ilmu Komunikasi Bidang Jurnalistik
        \App\ProgramStudi::create([
            'kode_program_studi' => '406',
            'singkatan_program_studi' => 'HUM',
            'nama_program_studi' => 'Ilmu Komunikasi Bidang Humas'
        ]);
    }
}
