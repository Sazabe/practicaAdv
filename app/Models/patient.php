<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    protected $table = 'patients';
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'front_user_id',
        'birthdate',
        'photo',
        'isActive',
    ];
    public function front_user(): BelongsTo{
        return $this->belongsTo(related: FrontUser::class);
    }
}

