<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\FrontUserResource\Pages;
use App\Filament\Manager\Resources\FrontUserResource\RelationManagers;
use App\Models\City;
use App\Models\FrontUser;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FrontUserResource extends Resource
{
    protected static ?string $model = FrontUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function getEloquentQuery(): Builder
    {
        $manager = Auth::guard('manager')->user();

        return parent::getEloquentQuery()
            ->whereIn('company_id', $manager->companies->pluck('id'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Personal Info')
                ->columns(2)
                ->schema([
                    
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('public_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->hiddenOn('edit')
                        ->required()
                        ->maxLength(255),
                    
                ]),
                    Section::make('Address Info')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('country_id')
                        ->relationship(name:'country', titleAttribute:'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('state_id',null);
                            $set('city_id',null);
                        })
                        ->required(),
                        Forms\Components\Select::make('state_id')
                        ->options (fn (Get $get):Collection => State::query()
                            ->where('country_id', $get('country_id'))
                            ->pluck('name','id')
                            )
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(fn (Set $set) => $set('city_id',null))
                        ->required(),
                        Forms\Components\Select::make('city_id')
                        ->options (fn (Get $get):Collection => City::query()
                            ->where('state_id', $get('state_id'))
                            ->pluck('name','id')
                            )
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('postalcode')
                        ->required()
                        ->maxLength(255),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('public_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable(isToggledHiddenByDefault:false)
                    ->sortable()
                    ->searchable(),
                    Tables\Columns\TextColumn::make('postal_code')
                    ->toggleable(isToggledHiddenByDefault:false)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
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
            'index' => Pages\ListFrontUsers::route('/'),
            'create' => Pages\CreateFrontUser::route('/create'),
            'edit' => Pages\EditFrontUser::route('/{record}/edit'),
        ];
    }
}
