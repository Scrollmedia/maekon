<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class MainContent
{
    public static function getSchema(): array
    {
        return [
            Grid::make(['sm' => 1, 'lg' => 2])
                ->schema([
                    TextInput::make('title')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get,  Set $set, ?string $state) {
                            if (!in_array($get('template'), ['directions', 'news', 'brands'])) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->label('Название'),
                    TextInput::make('slug')->required()
                        ->readOnly(fn(Get $get) => in_array($get('template'), ['directions', 'news', 'brands']))
                        ->label('Ярлык')->helperText(fn(Get $get) =>
                        in_array($get('template'), ['directions', 'news', 'brands'])
                            ? 'Для этого шаблона ярлык зафиксирован системой'
                            : 'Введите уникальный ярлык страницы'),
                ]),
        ];
    }
}
