<?php

namespace App\Filament\AdminUser\Resources\FrontUserResource\Pages;

use App\Filament\AdminUser\Resources\FrontUserResource;
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
