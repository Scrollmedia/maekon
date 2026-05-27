<?php

namespace App\Filament\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Set;

class  PostContent
{
    public static function getSchema(bool $hasExcerpt = true, bool $hasExcerpt2 = true): array
    {
        return [
            Section::make('Доп информация')
                ->schema([
                    TinyEditor::make('excerpt')
                        ->label('Краткое описание')
                        ->visible($hasExcerpt2)                      
                        ->columnSpanFull()
                       
                      ,
                    CuratorPicker::make('preview')
                        ->label('Превью')
                        ->buttonLabel('Из медиатеки')
                        ->color('primary')
                        ->preserveFilenames()
                        ->constrained(false)
                        ->required()
                        ->visible($hasExcerpt),
                    TextInput::make('sort_order')->default(1)->label('Сортировка')->numeric()
                ])->columns(2)
        ];
    }
}
