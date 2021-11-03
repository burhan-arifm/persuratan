<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticable
{
    use Notifiable;

    protected $fillable = [
        'name', 'nip', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
