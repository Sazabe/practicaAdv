<?php

namespace App\Filament\Manager\Resources\FrontUserResource\Pages;

use App\Filament\Manager\Resources\FrontUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFrontUser extends CreateRecord
{
    protected static string $resource = FrontUserResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
