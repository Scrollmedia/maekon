<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;

class AboutCompanyBlock
{
    public static function make(): Block
    {
        return Block::make('AboutCompanyBlock')

            ->label('О компании')
            ->icon('heroicon-o-user-group')
            ->schema([
                TextInput::make('title')->label('Заголовок главная карточка'),
                RichEditor::make('pod_title')->label('Подзаголовок главная карточка'),
                 CuratorPicker::make('image_id')
                    ->label('Изображение')
                    ->buttonLabel('Из медиатеки')
                    ->color('primary')
                    ->preserveFilenames()
                    ->constrained(false)
                    ->required(),
                TextInput::make('href')->label('Ссылка'),
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
                        ToggleButtons::make('little')
                                ->label('Шрифт меньше')
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
