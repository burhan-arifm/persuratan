<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IzinKunjungan extends Model
{
    protected $guarded = [
        'id'
    ];

    public function surat()
    {
        return $this->hasOne('App\Surat', 'surat');
    }
}
