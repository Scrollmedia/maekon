<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class  MainBrandBlock
{
    public static function make(): Block
    {
        return Block::make('brand_main')
            ->label('Главная Бренды')
            ->icon('heroicon-o-document-text');
    }
}
