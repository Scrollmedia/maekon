<?

namespace App\Filament\Support;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;

class MainPageBlocks
{


    public static function getMainPageBlocks(): array
    {
        // Список типов блоков, которые имеют одинаковую структуру (RichEditor)
        $standardBlocks = [
            'direction'  => 'Направления',
            'brand' => 'Бренды',
            'news'      => 'Новости',
        ];

        return collect($standardBlocks)->map(function ($label, $name) {
            return Block::make($name)
                ->label($label)
                ->schema([
                     ToggleButtons::make('visible')
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
                TextInput::make('title')->label('Заголовок'),             
                TextInput::make('pod_title')->label('Подпись'),             
                ])
                ->visible(fn(Get $get) => $get('../template') === 'main');
        })->toArray();
    }


    /**
     * Блок: Баннер на главной
     */
    public static function getBannerMain(): Block
    {
        return Block::make('banner_main')
            ->label('Баннер главная')
            ->visible(fn(Get $get) => $get('../template') === 'main')
            ->columns(2)
            ->schema([
                TextInput::make('title')->label('Главное название'),
                TextInput::make('title2')->label('Название под ним'),
                TextInput::make('href')->label('Ссылка на кнопку'),
                static::getCuratorField('image_id', 'Изображение'),
            ]);
    }

    /**
     * Блок: Слайдер на главной
     */
    public static function getSliderMain(): Block
    {
        return Block::make('slider_main')
            ->label('Слайдер главная')
            ->visible(fn(Get $get) => $get('../template') === 'main')
            ->schema([
                Repeater::make('slider')
                    ->label('Слайды')
                    ->itemLabel(fn(array $state): ?string => 'Слайд: ' . ($state['title'] ?? 'без названия'))
                    ->cloneable()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')->label('Название'),
                        TextInput::make('pod_title')->label('Подпись'),
                        static::getCuratorField('image_id', 'Изображение'),

                    ]),
            ]);
    }

    /**
     * Вспомогательный метод для одинаковых полей Curator (DRY)
     */
    protected static function getCuratorField(string $name, string $label): CuratorPicker
    {
        return CuratorPicker::make($name)
            ->label($label)
            ->buttonLabel('Из медиатеки')
            ->color('primary')
            ->preserveFilenames()
            ->constrained(false)
            ->required();
    }
}
