<?php

namespace App\Filament\Resources\Directions;

use App\Filament\Resources\Directions\Pages\CreateDirection;
use App\Filament\Resources\Directions\Pages\EditDirection;
use App\Filament\Resources\Directions\Pages\ListDirections;
use App\Filament\Resources\Directions\Pages\ViewDirection;
use App\Filament\Resources\Directions\Schemas\DirectionForm;
use App\Filament\Resources\Directions\Schemas\DirectionInfolist;
use App\Filament\Resources\Directions\Tables\DirectionsTable;
use App\Models\Direction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DirectionResource extends Resource
{
    protected static ?string $model = Direction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::WrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'Направления';
    protected static ?string $pluralModelLabel = 'Направления';
    protected static ?string $navigationLabel = 'Направления';
 

    public static function getNavigationGroup(): ?string
    {
        return 'Направления'; 
    }

    public static function form(Schema $schema): Schema
    {
        return DirectionForm::configure($schema->columns(1));
    }

    public static function infolist(Schema $schema): Schema
    {
        return DirectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DirectionsTable::configure($table);
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
            'index' => ListDirections::route('/'),
            'create' => CreateDirection::route('/create'),
            'edit' => EditDirection::route('/{record}/edit'),
            'view' => ViewDirection::route('/{record}'),
        ];
    }
}
