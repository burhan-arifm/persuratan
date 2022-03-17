<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class JobTraining extends Model
{
    use UseUuid;

    protected $guarded = [
        'id'
    ];

    public function surat()
    {
        return $this->hasOne('App\Surat', 'surat');
    }
}
