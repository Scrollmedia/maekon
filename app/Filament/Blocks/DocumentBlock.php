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

class DocumentBlock
{
    public static function make(): Block
    {
        return Block::make('documentsblock')

            ->label('Документы блок')
            ->icon('heroicon-o-document-arrow-down')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                RichEditor::make('pod_title')->label('Подзаголовок'),
                Repeater::make('blocks')
                    ->label('Документы')
                    ->schema([
                        TextInput::make('title')->label('Заголовок')->live(onBlur: true),
                        CuratorPicker::make('file')
                            ->label('Документ')
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
