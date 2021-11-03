<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo('App\JenisSurat', 'jenis_surat', 'kode_surat');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'pemohon', 'nim');
    }

    public function izin_kunjungan()
    {
        return $this->belongsTo('App\IzinKunjungan', 'surat');
    }

    public function izin_observasi()
    {
        return $this->belongsTo('App\IzinObservasi', 'surat');
    }

    public function izin_praktik()
    {
        return $this->belongsTo('App\IzinPraktik', 'surat');
    }

    public function izin_riset()
    {
        return $this->belongsTo('App\IzinRiset', 'surat');
    }

    public function job_training()
    {
        return $this->belongsTo('App\JobTraining', 'surat');
    }

    public function surat_keterangan()
    {
        return $this->belongsTo('App\Keterangan', 'surat');
    }

    public function permohonan_komprehensif()
    {
        return $this->belongsTo('App\Komprehensif', 'surat');
    }

    public function permohonan_munaqasah()
    {
        return $this->belongsTo('App\Munaqasah', 'surat');
    }

    public function pernyataan_masih_kuliah()
    {
        return $this->belongsTo('App\MasihKuliah', 'surat');
    }

    public function ppm()
    {
        return $this->belongsTo('App\PPM', 'surat');
    }
}
