<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IzinPraktik extends Model
{
    protected $guarded = [
        'id'
    ];

    public function persuratan()
    {
        return $this->hasOne('App\Persuratan', 'surat');
    }
}
