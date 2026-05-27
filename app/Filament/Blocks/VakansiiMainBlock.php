<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class VakansiiMainBlock
{
    public static function make(): Block
    {
        return Block::make('VakansiiMainBlock')

            ->label('Вакансии Главная')
            ->icon('heroicon-s-users')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('content')->label('Подзаголовок'),
                Repeater::make('blocks')
                    ->label('Элементы')
                    ->schema([
                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                          Repeater::make('ul')
                            ->label('Список')
                            ->schema([
                                TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                                 Repeater::make('li')
                                    ->label('Контент')
                                    ->schema([
                                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                                    ])
                                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                                    ->collapsed()
                            ])
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                            ->collapsed()
                            ->cloneable()
                            ->grid(2)
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                    ->cloneable()
                    ->collapsed()
            ]);
    }
}
