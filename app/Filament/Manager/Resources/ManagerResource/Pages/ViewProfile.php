<?php

namespace App\Filament\Manager\Resources\ManagerResource\Pages;

use App\Filament\Manager\Resources\ManagerResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Manager;
use Filament\Actions\Action;

class ViewProfile extends Page
{
    use Forms\Concerns\InteractsWithForms;
    
    protected static string $resource = ManagerResource::class;

    protected static string $view = 'filament.manager.resources.manager-resource.pages.view-profile';
    public ?Manager $record;

    public function mount(): void
    {
        $this->record = Auth::guard('manager')->user();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('email')
                ->label(__('manager.email'))
                ->disabled(),
            Forms\Components\DateTimePicker::make('email_verified_at')
                ->label(__('manager.email_verified_at'))
                ->disabled(),
            Forms\Components\TextInput::make('name')
                ->label(__('manager.name'))
                ->disabled(),
            Forms\Components\TextInput::make('public_name')
                ->label(__('manager.public_name'))
                ->disabled(),
            Forms\Components\Select::make('country_id')
                ->label(__('manager.country'))
                ->relationship('country', 'name')
                ->disabled(),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->label(__('Editar perfil'))
                ->url(route('filament.manager.resources.managers.edit', $this->record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
