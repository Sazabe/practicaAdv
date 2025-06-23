<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard = 'admin';

    protected $fillable = [
        'email',
        'password',
        'public_name',
        'name',
        'surname',
        'country_id',
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
    //Accesor clásico
    public function getFullNameWithIdAttribute(): string
    {
        return "{$this->name} {$this->surname} - {$this->id}";
    }
    /*
Alternativa moderna (comentada como referencia) para el accessor.
Permite modificar el get y set, añadida en laravel 9
use Illuminate\Database\Eloquent\Casts\Attribute;

protected function displayName(): Attribute
{
    return Attribute::make(
        get: fn () => "{$this->name} {$this->surname} - {$this->id}",
    );
}
*/
}
