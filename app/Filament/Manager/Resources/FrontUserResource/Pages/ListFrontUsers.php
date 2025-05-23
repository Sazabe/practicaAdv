<?php

namespace App\Filament\Manager\Resources\FrontUserResource\Pages;

use App\Filament\Manager\Resources\FrontUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFrontUsers extends ListRecords
{
    protected static string $resource = FrontUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
