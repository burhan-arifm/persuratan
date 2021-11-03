<?php

use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Surat Permohonan Izin Kunjungan
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'izin-kunjungan',
            'jenis_surat' => 'Izin Kunjungan',
            'perihal' => htmlentities('Permohonan Izin Kunjungan'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Permohonan Izin Observasi
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'izin-observasi',
            'jenis_surat' => 'Izin Observasi',
            'perihal' => htmlentities('Permohonan Izin Observasi<br>Lapangan/Konsultasi'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Permohonan Izin Praktik Mata Kuliah
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'izin-praktik',
            'jenis_surat' => 'Izin Praktik Mata Kuliah',
            'perihal' => htmlentities('Permohonan Izin<br>Praktik Mata Kuliah'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Permohonan Izin Riset
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'izin-riset',
            'jenis_surat' => 'Izin Riset',
            'perihal' => htmlentities('Permohonan Izin Riset<br>Survey/Konsultasi'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Permohonan Izin Job Training
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'job-training',
            'jenis_surat' => 'Izin Job Training',
            'perihal' => htmlentities('Permohonan Izin<br>Persiapan Job Training'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Permohonan Uji Komprehensif
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'permohonan-komprehensif',
            'jenis_surat' => 'Uji Komprehensif',
            'perihal' => htmlentities('Permohonan Ujian<br>Komprehensif'),
            'atas_nama' => '',
            'penanda_tangan' => '',
            'nip_penanda_tangan' => '',
            'jabatan_penanda_tangan' => ''
        ]);
        // Surat Permohonan Ujian Munaqasah
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'permohonan-munaqasah',
            'jenis_surat' => 'Ujian Munaqasah',
            'perihal' => htmlentities('Permohonan Ujian<br>Munaqasah/Skripsi'),
            'atas_nama' => '',
            'penanda_tangan' => '',
            'nip_penanda_tangan' => '',
            'jabatan_penanda_tangan' => ''
        ]);
        // Surat Pernyataan Masih Kuliah
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'pernyataan-masih-kuliah',
            'jenis_surat' => 'Pernyataan Masih Kuliah',
            'perihal' => '',
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Asep Rohendi, M.Ag.',
            'nip_penanda_tangan' => '196209101991031002',
            'jabatan_penanda_tangan' => 'Kepala Bagian Tata Usaha'
        ]);
        // Surat Permohonan Izin PPM
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'ppm',
            'jenis_surat' => 'Izin PPM',
            'perihal' => htmlentities('Permohonan Izin<br>Persiapan Praktik Profesi Mahasiswa (PPM)'),
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dr. H. Enjang AS, M.Ag., M.Si.',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Akademik'
        ]);
        // Surat Keterangan
        DB::table('jenis_surats')->insert([
            'kode_surat' => 'surat-keterangan',
            'jenis_surat' => 'Surat Keterangan',
            'perihal' => '',
            'atas_nama' => 'Dekan',
            'penanda_tangan' => 'Dadan Suherdiana',
            'nip_penanda_tangan' => '196808141995031003',
            'jabatan_penanda_tangan' => 'Wakil Dekan Bidang Kemahasiswaan'
        ]);
    }
}
