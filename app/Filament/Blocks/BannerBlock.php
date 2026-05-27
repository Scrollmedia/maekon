<?php

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class BannerBlock
{
    public static function make(): Block
    {
        return Block::make('banner')
            ->label('Баннер')
            ->icon('heroicon-o-rectangle-stack')
            ->schema([
                TextInput::make('title')->label('Заголовок')
                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Если заполнить, то он будет отображаться, вместо главного названия'),
                CuratorPicker::make('image_id')
                ->label('Изображение')
                ->buttonLabel('Из медиатеки')
                ->color('primary')
                ->preserveFilenames()
                ->constrained(false)
                ->required()
                //RichEditor::make('pod_title')->label('Подзаголовок'),
                //Toggle::make('button')->label('Ссылка на форму')
            ]);
    }
}
