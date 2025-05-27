<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'name',
        'public_name',
        'password',
        'admin_user_id',
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
    public function admin_user():BelongsTo{
        return $this->belongsTo(related: AdminUser::class);
    }
    public function companies(): BelongsToMany
{
    return $this->belongsToMany(Company::class, 'manager_company', 'manager_id', 'company_id');
}
}
