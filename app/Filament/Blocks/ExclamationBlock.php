<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ExclamationBlock
{
    public static function make(): Block
    {
        return Block::make('exclamation')

            ->label('Уведомление блок')
            ->icon('heroicon-o-exclamation-circle')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('content')->label('Контент')
                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'в сслыке mailto:hr@maekon.by или tel:+375291111111'),
            ]);
    }
}
