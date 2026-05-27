<?php

namespace App\Filament\Resources\Directions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DirectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('Название'),
                TextEntry::make('slug')->label('Ярлык'),
                TextEntry::make('sort_order')->label('сортировка'),
                IconEntry::make('publish')->label('Опубликовано')
                    ->boolean(),
                TextEntry::make('excerpt')->label('Краткое описание')
                    ->placeholder('-'),
 
                TextEntry::make('created_at')->label('Дата создания')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')->label('Дата обновления')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
