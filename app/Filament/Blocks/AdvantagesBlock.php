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

class AdvantagesBlock
{
    public static function make(): Block
    {
        return Block::make('advantages')
            ->label('Преимущества')
            ->icon('heroicon-o-link')
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок'),
                RichEditor::make('content')
                    ->label('Текст'),
                TextInput::make('title2')
                    ->label('Заголовок второй'),
                Repeater::make('blocks')
                    ->label('Элементы')
                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Выводятся слева направо')
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
                        CuratorPicker::make('file')
                                        ->label('Сертификат')
                                        ->buttonLabel('Из медиатеки')
                                        ->color('primary')
                                        ->preserveFilenames()
                                        ->directory('files')
                                        ->constrained(false),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                    ->collapsed()
                    ->grid(2)
            ]);
    }
}
