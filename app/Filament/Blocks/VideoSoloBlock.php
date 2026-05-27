<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class VideoSoloBlock
{
    public static function make(): Block
    {
        return Block::make('VideoSoloBlock')
            ->label('Видео 1 блок')
            ->icon('heroicon-s-video-camera')
            ->schema([
                TextInput::make('title')->label('Заголовок'),
                TextInput::make('href')->label('Ютуб ссылка')->placeholder('https://www.youtube.com/embed/ICqKcPD639k?si=FqislR2WDNxkgZVf'),
                RichEditor::make('content')->label('Подзаголовок'),
                CuratorPicker::make('file')
                    ->label('Видео')
                    ->buttonLabel('Из медиатеки')
                    ->color('primary')
                    ->preserveFilenames()
                    ->directory('files')
                    ->constrained(false),
            ]);
    }
}
