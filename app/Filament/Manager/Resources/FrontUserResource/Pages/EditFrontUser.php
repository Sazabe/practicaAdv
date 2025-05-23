<?php

namespace App\Filament\Manager\Resources\FrontUserResource\Pages;

use App\Filament\Manager\Resources\FrontUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFrontUser extends EditRecord
{
    protected static string $resource = FrontUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
