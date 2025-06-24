<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;


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
        return $this->belongsTo(related: country::class);
    }
    public function state(): BelongsTo{
        return $this->belongsTo(related: state::class);
    }
    public function city(): BelongsTo{
        return $this->belongsTo(related: city::class);
    }
    public function companies(): BelongsToMany
{
    return $this->belongsToMany(Company::class, 'company_building', 'building_id', 'company_id');
}
}
