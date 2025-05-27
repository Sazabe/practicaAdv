<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class State extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'country_id',
        'name',
        'country_code',
    ];
    public function country(): BelongsTo
    {
        return $this->belongsTo(related: Country::class);
    }
}
