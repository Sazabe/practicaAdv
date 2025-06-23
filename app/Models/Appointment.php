<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    protected $table = 'appointments';
    use HasFactory, Notifiable;
    protected $fillable = [
        'room_id',
        'patient_id',
        'date',
    ];
}
