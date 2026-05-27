<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class SliderTextBlock
{
    public static function make(): Block
    {
        return Block::make('slidertext')
            ->label('Текст + Слайдер + Текст')
            ->icon('heroicon-o-pause')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('content')
                    ->label('Текст'),
                Repeater::make('slider')
                    ->label('Слайды')
                    ->itemLabel(fn(array $state): ?string => 'Слайд: ' . ($state['title'] ?? 'без названия'))
                    ->cloneable()
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('title')->label('Название'),
                        TextInput::make('pod_title')->label('Подпись'),
                        CuratorPicker::make('image_id')
                            ->label('Изображение')
                            ->buttonLabel('Из медиатеки')
                            ->color('primary')
                            ->preserveFilenames()
                            ->constrained(false)
                            ->required()
                        ]),
                TextInput::make('title2')->label('Заголовок 2'),
                RichEditor::make('content2')
                    ->label('Текст 2')
            ]);
    }
}
