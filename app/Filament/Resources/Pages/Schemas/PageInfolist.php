<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('Название'),
                TextEntry::make('slug')->label('Ярлык'),
                TextEntry::make('template')->label('Шаблон'),
                IconEntry::make('publish')->label('Опубликовано')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime()
                    ->placeholder('-'),
                
                 
            ]);
    }
}
