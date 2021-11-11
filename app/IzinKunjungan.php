<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class IzinKunjungan extends Model
{
    use UseUuid;

    protected $guarded = [
        'id'
    ];

    public function surat()
    {
        return $this->hasOne('App\Surat', 'surat');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\ProgramStudi', 'program_studi', 'kode_prodi');
    }
}
