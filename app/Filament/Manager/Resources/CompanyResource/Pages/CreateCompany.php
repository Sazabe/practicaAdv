<?php

namespace App\Filament\Manager\Resources\CompanyResource\Pages;

use App\Filament\Manager\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;
    protected function afterCreate(): void
    {
        $manager = Auth::guard('manager')->user();
        $this->record->managers()->attach($manager->id);
    }
}
