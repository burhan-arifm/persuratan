<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class JenisSurat extends Model
{
    use UseUuid;

    protected $guarded = [
        'id'
    ];

    public function surat()
    {
        return $this->hasMany('App\Surat', 'jenis_surat');
    }
}
