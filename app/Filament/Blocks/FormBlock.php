<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class FormBlock
{
    public static function make(): Block
    {
        return Block::make('form')

            ->label('Форма')
            ->icon('heroicon-o-envelope-open')
            ->schema([
                TextInput::make('title')->label('Заголовок1'),
                TextInput::make('title2')->label('Заголовок2'),
            ]);
    }
}
