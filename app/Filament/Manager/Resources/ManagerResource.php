<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\ManagerResource\Pages;
use App\Filament\Manager\Resources\ManagerResource\RelationManagers;
use App\Models\Manager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ManagerResource extends Resource
{
    protected static ?string $model = Manager::class;
    protected static ?string $navigationLabel = 'Mi perfil';
    protected static ?string $modelLabel = 'Mi perfil';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'mi-perfil'; //Define la url, en vez de ser /manager/managers sale /manager/mi-perfil

    public static function getEloquentQuery(): Builder
    {
        $manager = Auth::guard('manager')->user();

        return parent::getEloquentQuery()
            ->where('id', $manager->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* No puede crearse a si mismo, solo modificarse y no asignarse un admin user
                Forms\Components\Select::make('admin_user_id')
                    ->label(__('manager.admin_user'))
                    ->relationship('admin_user', 'display_name')
                    ->required(),*/
                Forms\Components\TextInput::make('email')
                    ->label(__('manager.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('name')
                    ->label(__('manager.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('public_name')
                    ->label(__('manager.public_name'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('country_id')
                    ->label(__('manager.country'))
                    ->relationship('country', 'name')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Igual quito el admin user name
                Tables\Columns\TextColumn::make('admin_user.name')
                    ->label(__('manager.admin_user_name'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('manager.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label(__('manager.email_verified_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('manager.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('public_name')
                    ->label(__('manager.public_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('manager.country'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('manager.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('manager.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }
}
