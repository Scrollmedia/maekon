<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;

class ContactsMainBlock
{
    public static function make(): Block
    {
        return Block::make('ContactsMainBlock')

            ->label('Контакты Главная')
            ->icon('heroicon-s-users')
            ->schema([
                TextInput::make('coords')->label('Координаты')->columnSpanFull(),
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
                                       Radio::make('type')
                                        ->label('Тип')
                                        ->options([
                                            'text' => 'Текст',
                                            'email' => 'Email',
                                            'phone' => 'Телефон',
                                        ])
                                        ->default('text')
                                        ->nullable()
                                        ->dehydrateStateUsing(fn ($state) => $state ?? false)
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
                    ->columnSpanFull(),
                    TextInput::make('coordsTitle')->label('Заголовок Карта'),
                    TextInput::make('coords2')->label('Координаты 2'),
                    TextInput::make('requizitTitle')->label('Заголовок Реквизиты'),
                    CuratorPicker::make('file')
                                        ->label('Реквизит')
                                        ->buttonLabel('Из медиатеки')
                                        ->color('primary')
                                        ->preserveFilenames()
                                        ->directory('files')
                                        ->constrained(false),
                    Repeater::make('requizitblocks')
                    ->label('Элементы реквизиты')
                    ->schema([
                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                        TextInput::make('content')->label('Контент'),
                    ])
                    ->columns(2)
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Новый пункт')
                    ->collapsed()
                    ->columnSpanFull()
            ])
            ->columns(2)
            ;
    }
}
