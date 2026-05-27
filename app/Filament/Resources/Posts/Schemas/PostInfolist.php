<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
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
                TextEntry::make('tags.name') // Обращаемся через точку: связь.поле
                    ->label('Тэги')
                    ->listWithLineBreaks()   // Каждый тег с новой строки (опционально)
                    ->bulleted(),            // Добавить маркеры списка (опционально)
                TextEntry::make('created_at')->label('Дата создания')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')->label('Дата обновления')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
