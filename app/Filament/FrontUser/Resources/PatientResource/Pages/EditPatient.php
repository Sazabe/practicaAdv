<?php

namespace App\Filament\FrontUser\Resources\PatientResource\Pages;

use App\Filament\FrontUser\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatient extends EditRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
