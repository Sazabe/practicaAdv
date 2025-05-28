<?php

namespace App\Filament\FrontUser\Resources\FrontUserResource\Pages;

use App\Filament\FrontUser\Resources\FrontUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFrontUser extends CreateRecord
{
    protected static string $resource = FrontUserResource::class;
}
