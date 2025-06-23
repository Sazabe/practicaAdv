<?php

namespace App\Filament\AdminUser\Resources\PatientResource\Pages;

use App\Filament\AdminUser\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;
}
