<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class Building extends Model
{
    protected $table = 'buildings';
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'public_name',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'postalcode',
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
    public function companies(): BelongsToMany
{
    return $this->belongsToMany(Company::class, 'company_building', 'building_id', 'company_id');
}
}
