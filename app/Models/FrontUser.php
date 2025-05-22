<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class FrontUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'name',
        'public_name',
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
    
    public function country(): BelongsTo{
        return $this->belongsTo(related: Country::class);
    }
    public function state(): BelongsTo{
        return $this->belongsTo(related: State::class);
    }
    public function city(): BelongsTo{
        return $this->belongsTo(related: City::class);
    }
}
