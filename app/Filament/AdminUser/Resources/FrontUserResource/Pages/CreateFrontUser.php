<?php

namespace App\Filament\AdminUser\Resources\FrontUserResource\Pages;

use App\Filament\AdminUser\Resources\FrontUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFrontUser extends CreateRecord
{
    protected static string $resource = FrontUserResource::class;
}
