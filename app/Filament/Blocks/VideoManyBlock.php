<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class VideoManyBlock
{
    public static function make(): Block
    {
        return Block::make('VideoManyBlock')
            ->label('Видео Несколько')
            ->icon('heroicon-o-video-camera')
            ->schema([
                Repeater::make('blocks')
                    ->label('Видео')
                    ->schema([
                        TextInput::make('title')->label('Заголовок')->live($onBlur = true),
                        TextInput::make('href')->label('Ютуб ссылка')->placeholder('https://www.youtube.com/embed/ICqKcPD639k?si=FqislR2WDNxkgZVf'),
                        CuratorPicker::make('file')
                            ->label('Видео')
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
