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

class CharacterMainBlock
{
    public static function make(): Block
    {
        return Block::make('charachtermainblock')

            ->label('Технические Характеристики')
            ->icon('heroicon-s-clipboard-document-list')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                Repeater::make('table_headers')
                    ->label('Колонки таблицы (в ширь)')
                    ->live() 
                    ->defaultItems(3)
                    ->grid(3)
                    ->schema([
                        TextInput::make('col_title')
                            ->label('Название колонки')
                            ->required(),
                    ])
                    ->cloneable(),

                Repeater::make('table_rows')
                    ->label('Строки с данными (вниз)')
                    ->defaultItems(1)
                    ->schema(function (Get $get) {
                        $headers = $get('table_headers') ?? [];
                        $fields = [];
                        $columnIndex = 0;
                        foreach ($headers as $key => $header) {
                           $colName = !empty($header['col_title']) 
                            ? $header['col_title'] 
                            : ('Колонка ' . ($columnIndex + 1));
                            $fields[] = TextInput::make('cell_' . $columnIndex)
                            ->label($colName)
                            ->placeholder('Значение...');
                            $columnIndex++;
                        }
                        return $fields;
                    })
                    ->grid(3) 
                    ->cloneable()
            ]);
    }
}
