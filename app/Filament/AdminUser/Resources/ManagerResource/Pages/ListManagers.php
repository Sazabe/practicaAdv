<?php

namespace App\Filament\AdminUser\Resources\ManagerResource\Pages;

use App\Filament\AdminUser\Resources\ManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManagers extends ListRecords
{
    protected static string $resource = ManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
