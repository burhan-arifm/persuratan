<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    protected $guarded = [];

    public $incrementing = false;

    public function jurusan()
    {
        return $this->belongsTo('App\ProgramStudi', 'program_studi', 'kode_prodi');
    }
    public function surat()
    {
        return $this->hasMany('App\Surat', 'pemohon', 'nim');
    }
}
