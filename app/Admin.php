<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UseUuid;

class Admin extends Authenticable
{
    use Notifiable, UseUuid;

    protected $fillable = [
        'name', 'nip', 'username', 'email', 'password', 'is_admin'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
