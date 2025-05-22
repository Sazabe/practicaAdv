<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class Company extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'cif',
        'email',
        'phone',
        'address',
        'postalcode',
        'country_id',
        'state_id',
        'city_id',
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
