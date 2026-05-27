<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;

class CharacterBlock
{
    public static function make(): Block
    {
        return Block::make('charachterblock')

            ->label('Основные Характеристики')
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('pod_title')->label('Подзаголовок'),
                Repeater::make('blocks')
                    ->label('блоки')
                    ->schema([
                      ToggleButtons::make('number')
                                ->label('Число')
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
                                ])
                                ->default(false)
                                ->live(),
                        
                        TextInput::make('prefix')->label('Префикс')->visible(fn (Get $get): bool => $get('number') === true),
                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                        
                        Textarea::make('text')->label('Описание'),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                    ->collapsed()
                    ->grid(2)
            ]);
    }
}
