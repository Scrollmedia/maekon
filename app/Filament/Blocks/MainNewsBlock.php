<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class  MainNewsBlock
{
    public static function make(): Block
    {
        return Block::make('news_main')
            ->label('Главная Новости')
            ->icon('heroicon-o-document-text');
    }
}
