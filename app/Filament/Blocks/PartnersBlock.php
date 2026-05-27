<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;

class  PartnersBlock
{
    public static function make(): Block
    {
        return Block::make('partners')
                ->label('Партнеры')
                ->icon('heroicon-c-briefcase')
                ->schema([
                     ToggleButtons::make('visible')
                                ->label('Опубликовано')
                                ->boolean()
                                ->grouped()
                                ->options([
                                    true => 'Да',
                                    false => 'Нет',
                                ])
                                ->icons([
                                    true => 'heroicon-o-check-circle',
                                    false => 'heroicon-o-x-circle',
                                ])
                                ->colors([
                                    true => 'success',
                                    false => 'gray',
                                ]),
                ]);
 
    }
}

            