<?php

namespace App\Filament\Resources\FronUserResource\Pages;

use App\Filament\Resources\FronUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFronUsers extends ListRecords
{
    protected static string $resource = FronUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
