<?php

namespace App\Filament\FrontUser\Resources\AppointmentResource\Pages;

use App\Filament\FrontUser\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;
}
