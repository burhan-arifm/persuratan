<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class IzinRiset extends Model
{
    use UseUuid;

    protected $guarded = [
        'id'
    ];

    public function persuratan()
    {
        return $this->hasOne('App\Persuratan', 'surat');
    }
}
