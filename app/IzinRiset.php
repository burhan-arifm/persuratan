<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IzinRiset extends Model
{
    protected $guarded = [
        'id'
    ];

    public function persuratan()
    {
        return $this->hasOne('App\Persuratan', 'surat');
    }
}
