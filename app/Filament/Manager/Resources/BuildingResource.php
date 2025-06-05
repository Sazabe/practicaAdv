<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\BuildingResource\Pages;
use App\Filament\Manager\Resources\BuildingResource\RelationManagers;
use App\Models\Building;
use App\Models\City;
use App\Models\State;
use Filament\Forms;
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

class BuildingResource extends Resource
{
    protected static ?string $model = Building::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('public_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('companies')
                    ->multiple()
                    ->relationship(
                        name: 'companies',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->whereIn(
                            'id',
                            auth('manager')->user()?->companies->pluck('id') ?? []
                        )
                    )
                    /*->options(function () {
                        $manager = auth('manager')->user();
                        if (!$manager) {
                            return [];
                        }
                        return $manager->companies->pluck('name', 'id');
                    })*/
                    ->preload()
                    ->required(),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('public_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('companies.name')
                    ->label('Compañías')
                    ->badge()
                    ->separator(', ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postalcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListBuildings::route('/'),
            'create' => Pages\CreateBuilding::route('/create'),
            'edit' => Pages\EditBuilding::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $manager = Auth::guard('manager')->user();

        return parent::getEloquentQuery()
            ->whereHas('companies', function ($query) use ($manager) {
                $query->whereIn('id', $manager->companies->pluck('id'));
            });
    }
}
