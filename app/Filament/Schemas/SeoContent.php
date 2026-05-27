<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class SeoContent
{
    public static function getSchema(bool $hasExcerpt = true): array
    {
        return [
           Group::make()
            ->relationship('seo')  
            ->schema([
                TextInput::make('title')
                    ->label('SEO заголовок'),

                Textarea::make('description')
                    ->label('Мета Описание')
                    ->rows(3),

                TextInput::make('noidex')
                    ->helperText('Пример index, follow')
                    ->label('Индексация'),

                TextInput::make('og_title')
                    ->label('OG заголовок'),

                Textarea::make('og_description')
                    ->label('OG описание')
                    ->rows(3),
                    
                TextInput::make('og_img')
                    ->label('OG изображение'),

                TextInput::make('og_type')
                    ->helperText('Пример website, article, profile')
                    ->label('OG тип'),
            ])
            ->columnSpanFull(),
        ];
    }
}
