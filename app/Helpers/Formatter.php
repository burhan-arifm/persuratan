<?php
namespace App\Helpers;

class Formatter  
{
    /**
     * Menyesuaikan data yang diambil dengan tabel yang
     * telah ditentukan formatnya.
     * 
     * @param $surat
     * Objek mengenai data surat yang dihimpun
     * 
     * @param $tampilkan
     * Menampilkan surat berdasarkan status pengajuan
     * 
     * @return Array objek yang telah diatur formatnya
     * sesuai dengan yang telah ditentukan sebemumnya
     */
    public static function surat_table($surat, $tampilkan)
    {
        $time = \Carbon\Carbon::parse($surat->updated_at);
        $tanggal_terbit = \Carbon\Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
        $nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $tanggal_terbit->month, $tanggal_terbit->year);
        $letter = array(
            'id' => $surat->id,
            'nomor_surat'    => $nomor_surat,
            'jenis_surat'    => $surat->jenis->jenis_surat,
            'identitas'      => ($surat->jenis_surat == 'izin-kunjungan') ? $surat->izin_kunjungan->program_studi : $surat->mahasiswa->nim,
            'pemohon'        => ($surat->jenis_surat == 'izin-kunjungan') ? $surat->izin_kunjungan->semester.'-'.$surat->izin_kunjungan->kelas : $surat->mahasiswa->nama,
            'waktu_readable' => ($tampilkan == 'semua') ? $time->isoFormat('LLLL') : $time->diffForHumans(),
            'waktu'          => $surat->updated_at
        );

        return $letter;
    }
}
