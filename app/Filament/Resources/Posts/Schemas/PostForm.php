<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Schemas\ContentBuilder;
use App\Filament\Schemas\MainContent;
use App\Filament\Schemas\PostContent;
use App\Filament\Schemas\SeoContent;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->components([
                 Grid::make(12)->schema([
                     Tabs::make('Tabs')
                        ->tabs([
                            Tab::make('Основной контент')
                                ->schema([
                                    ...MainContent::getSchema(),
                                    ...PostContent::getSchema(true, true),
 
                                ]),

                            Tab::make('Конструктор')
                                ->schema([
                                    ContentBuilder::getSchema(),
                                ]),
                            Tab::make('СЕО')->schema([
                                ...SeoContent::getSchema(),
                            ]),
                        ])
                         ->columnSpan([
                            'default' => 12,
                            'lg' => 8,
                        ]),

                         Section::make('Статус')
                        ->schema([
                            ToggleButtons::make('publish')
                                ->label('Опубликовано')
                                ->boolean()
                                ->grouped()
                                ->options([
                                    true => 'Да',
                                    false => 'Нет',
                                ])
                                ->icons([
                                    true => 'heroicon-o-check-circle',
                                    false => 'heroicon-o-x-circle',
                                ])
                                ->colors([
                                    true => 'success',
                                    false => 'gray',
                                ])->required(),
                            DatePicker::make('created_at')
                            ->label('Дата создания')
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 4,
                        ]),

                 ])
            ]);
    }
}
