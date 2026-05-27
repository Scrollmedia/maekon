<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class StandartsBlock
{
    public static function make(): Block
    {
        return Block::make('standarts')

            ->label('Качество и стандарты')
            ->icon('heroicon-c-squares-plus')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                Repeater::make('blocks')
                    ->label('Слайды')
                    ->schema([
                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                        RichEditor::make('text')->label('Контент'),
                        CuratorPicker::make('image_id')
                        ->label('Изображение')
                        ->buttonLabel('Из медиатеки')
                        ->color('primary')
                        ->preserveFilenames()
                        ->constrained(false)
                        ->required(),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                    ->collapsed()
                    ->grid(2)

            ]);
    }
}
