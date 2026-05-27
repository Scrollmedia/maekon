<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class SliderSoloBlock
{
    public static function make(): Block
    {
        return Block::make('slidersolo')
            ->label('Слайдер обычный')
            ->icon('heroicon-o-identification')
            ->schema([
                Repeater::make('slider')
                    ->label('Слайды')
                    ->itemLabel(fn(array $state): ?string => 'Слайд: ' . ($state['title'] ?? 'без названия'))
                    ->cloneable()
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('title')->label('Название'),
                        RichEditor::make('pod_title')->label('Текст'),
                        RichEditor::make('pod_title2')->label('Текст 2'),
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
