<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    protected $table = 'rooms';
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'building_id',
        'type',
    ];
    public function building(): BelongsTo{
        return $this->belongsTo(related: Building::class);
    }
}
