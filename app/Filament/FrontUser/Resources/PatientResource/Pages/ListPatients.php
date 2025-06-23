<?php

namespace App\Filament\FrontUser\Resources\PatientResource\Pages;

use App\Filament\FrontUser\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
