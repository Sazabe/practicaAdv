<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FrontUser extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'front';

    protected $fillable = [
        'email',
        'password',
        'name',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'postcode',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
