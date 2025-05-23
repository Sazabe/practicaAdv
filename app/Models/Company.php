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

class Company extends Model
{
    protected $table = 'companies';
    use HasFactory, Notifiable;
    protected $fillable = [
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
    public function buildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class, 'company_building', 'company_id', 'building_id');
    }
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(Manager::class, 'manager_company', 'manager_id', 'company_id');
    }
}
