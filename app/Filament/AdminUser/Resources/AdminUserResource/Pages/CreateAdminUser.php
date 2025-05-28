<?php

namespace App\Filament\AdminUser\Resources\AdminUserResource\Pages;

use App\Filament\AdminUser\Resources\AdminUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminUser extends CreateRecord
{
    protected static string $resource = AdminUserResource::class;
}
