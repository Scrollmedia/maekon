<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class VakansiiBlock
{
    public static function make(): Block
    {
        return Block::make('VakansiiBlock')

            ->label('Вакансии блок')
            ->icon('heroicon-s-users')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('content')->label('Подзаголовок'),
                TextInput::make('href')->label('Ссылка'),
                CuratorPicker::make('image_id')
                ->label('Изображение')
                ->buttonLabel('Из медиатеки')
                ->color('primary')
                ->preserveFilenames()
                ->constrained(false)
                ->required()
            ]);
    }
}
