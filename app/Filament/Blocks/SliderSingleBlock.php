<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class SliderSingleBlock
{
    public static function make(): Block
    {
        return Block::make('slider_single')
            ->label('Слайдер один(новости)')
            ->icon('heroicon-o-identification')
            ->schema([
                Repeater::make('slider')
                    ->label('Слайды')
                    ->cloneable()
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        CuratorPicker::make('image_id')
                            ->label('Изображение')
                            ->buttonLabel('Из медиатеки')
                            ->color('primary')
                            ->preserveFilenames()
                            ->constrained(false)
                            ->required()
                        ]),
            ]);
    }
}
