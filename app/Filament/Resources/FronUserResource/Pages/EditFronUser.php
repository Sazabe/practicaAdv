<?php

namespace App\Filament\Resources\FronUserResource\Pages;

use App\Filament\Resources\FronUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFronUser extends EditRecord
{
    protected static string $resource = FronUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
