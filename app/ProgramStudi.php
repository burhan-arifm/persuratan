<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class ProgramStudi extends Model
{
    use UseUuid;

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->hasMany('App\Mahasiswa', 'program_studi');
    }

    public function izin_kunjungan()
    {
        return $this->hasMany('App\IzinKunjungan', 'program_studi');
    }
}
