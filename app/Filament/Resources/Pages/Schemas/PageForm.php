<?php

namespace App\Filament\Resources\Pages\Schemas;


use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use App\Filament\Schemas\ContentBuilder;
use App\Filament\Schemas\MainContent;
use App\Filament\Schemas\SeoContent;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class PageForm
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

                                ]),


                            Tab::make('Конструктор')
                                ->schema(function (Get $get) {

                                    $builder = ContentBuilder::getSchema(
                                        false,
                                        false,
                                        template: $get('template')
                                    );

                                    return [
                                        $builder
                                    ];
                                }),
                            Tab::make('СЕО')->schema([
                                ...SeoContent::getSchema(),
                            ]),

                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 8,
                        ]),

                    // Правая колонка (Настройки/Мета)

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
                                ]),

                            // Статичный Select
                            Select::make('template')
                                ->label('Шаблон страницы')
                                ->options([
                                    'default' => 'Стандартный',
                                    'main' => 'Главная',
                                    'contacts' => 'Контакты',
                                    'directions' => 'Направления главная',
                                    'news' => 'Новости главная',
                                    'brands' => 'Бренды главная',
                                ])
                                ->default('default')
                                ->selectablePlaceholder(false)
                                ->native(false)
                                ->live()
                                ->afterStateUpdated(function (Set $set, ?string $state) {
                                    if ($state === 'directions') {
                                        $set('slug', 'directions');
                                    }
                                    if ($state === 'news') {
                                        $set('slug', 'blog');
                                    }
                                    if ($state === 'brands') {
                                        $set('slug', 'brands');
                                    }
                                }),
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 4,
                        ]),


                ]),
            ]);
    }
}
