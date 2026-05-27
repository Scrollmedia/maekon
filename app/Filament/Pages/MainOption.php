<?php

namespace App\Filament\Pages;


use App\Models\MainOption as ModelsMainOption;
use App\Models\Page as ModelsPage;
 
use Awcodes\Curator\Components\Forms\CuratorPicker;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;


class MainOption extends Page 
{
    
 
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $title = 'Глобальные настройки';
    protected string $view = 'filament.pages.main-option';

    public ?array $data = [];

 

    public static function getNavigationGroup(): ?string
    {
        return 'Контент';
    }

    public function mount(): void
    {
        $allOptions = ModelsMainOption::all()->keyBy('name');

        $formData = $allOptions->map->content->toArray();

        $menuKeys = ['main_menu', 'footer_menu'];
        $menuData = [];

        foreach ($menuKeys as $key) {
            if ($option = $allOptions->get($key)) {
                $menuData[] = [
                    'type' => $key,
                    'items' => $option->content['items'] ?? [],
                ];
            }
        }

        $formData['menu'] = $menuData;

        $this->form->fill($formData);
    }


    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Form::make([
                    Tabs::make('Settings')
                        ->tabs([
                            Tabs\Tab::make('Основное')
                                ->icon('heroicon-m-cog')
                                ->schema([
                                    CuratorPicker::make('logo')
                                        ->label('Логотип')
                                        ->buttonLabel('Из медиатеки')
                                        ->color('primary')
                                        ->preserveFilenames()
                                        ->constrained(false)
                                        ->columnSpanFull(),

 
                                    TextInput::make('politics')->label('Ссылка  Сайт Технопарка ')->helperText('ярлык прим: politics'),
                                    TextInput::make('cookies')->label('Ссылка Сайт Ассоциации технопарков')->helperText('ярлык прим: politics'),
                                ])->columns(2),
                            Tabs\Tab::make('Меню')
                                ->icon('heroicon-o-list-bullet')
                                ->schema([
                                    Repeater::make('menu')
                                        ->label('Меню')
                                        ->schema([
                                            Select::make('type')
                                                ->label('Тип меню')
                                                ->options([
                                                    'main_menu' => 'Главное',
                                                    'footer_menu' => 'Футер меню',
                                                ])
                                                ->native(false)
                                                ->live()
                                                ->default('main_menu'),

                                            Repeater::make('items')
                                                ->label('Пункты меню')
                                                ->schema([
                                                    TextInput::make('label')
                                                        ->label('Название в меню')
                                                        ->required(),

                                                    Select::make('type')
                                                        ->label('Тип страницы')
                                                        ->options([
                                                            'page' => 'Страница',
                                                            'custom' => 'Своя ссылка',
                                                        ])
                                                        ->native(false)
                                                        ->live()
                                                        ->default('page'),

                                                    Select::make('page_id') // Сохраняем ID страницы
                                                        ->label('Ссылка на страницу')
                                                        ->visible(fn(Get $get) => $get('type') === 'page')
                                                        ->options(ModelsPage::pluck('title', 'id'))
                                                        ->searchable()
                                                        ->reactive()
                                                        ->afterStateUpdated(function (Set $set, $state) {
                                                            if ($state) {
                                                                $title = ModelsPage::find($state)?->title;
                                                                $set('label', $title);
                                                            }
                                                        }),
                                                    TextInput::make('custom_url')
                                                        ->label('Произвольная ссылка')
                                                        ->visible(fn(Get $get) => $get('type') === 'custom'),


                                                ])
                                                ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'Новый пункт')
                                                ->columns(2)
                                                ->cloneable()
                                                ->collapsible()
                                                ->collapsed(),
                                        ])
                                        ->itemLabel(
                                            fn(array $state): ?string =>
                                            match ($state['type'] ?? null) {
                                                'main_menu' => 'Главное меню',
                                                'footer_menu' => 'Меню футера',
                                                default => 'Новое меню'
                                            }
                                        )
                                        ->maxItems(3)
                                        ->collapsed()
                                        ->collapsible(),


                                ]),

                            Tabs\Tab::make('Контакты')
                                ->icon('heroicon-o-phone')
                                ->schema([
                                    TextInput::make('phone')->label('Телефон'),
                                    TextInput::make('email')->label('Email'),
                                    TextInput::make('address')->label('Адрес'),
                                    TextInput::make('coordinats')
                                        ->label('Координаты')
                                        ->placeholder('53.881892, 27.593928'),
                                    /*
                                    CuratorPicker::make('requizitfile')
                                        ->label('Реквизиты')
                                        ->buttonLabel('Из медиатеки')
                                        ->color('primary')
                                        ->preserveFilenames()
                                        ->directory('files')
                                        ->constrained(false),

                                    Repeater::make('dopphones')
                                        ->grid(['sm' => 1, 'lg' => 2])
                                        ->label('Доп телефоны')
                                        ->schema([
                                            TextInput::make('phone')
                                                ->label('Телефон')
                                                ->required(),
                                        ]),
                                        */
                                ])->columns(2),

                            Tabs\Tab::make('Соцсети')
                                ->icon('heroicon-o-share')
                                ->schema([
                                    Repeater::make('socials')
                                        ->label('Список ссылок')
                                        ->schema([
                                            TextInput::make('platform')->label('Сеть (insta, fb, in, tg, ws, vb, you)'),
                                            TextInput::make('url')->label('Ссылка'),
                                        ])
                                        ->itemLabel(fn(array $state): ?string => $state['platform'] ?? 'Новый пункт')
                                        ->collapsed(),
                                ]),

                            Tabs\Tab::make('SEO / Скрипты')
                                ->icon('heroicon-o-code-bracket')
                                ->schema([
                                    Textarea::make('header_scripts')->label('Код в <head>'),
                                    Textarea::make('footer_scripts')->label('Код перед </body>'),
                                ]),
                            Tabs\Tab::make('Партнеры')
                                ->icon('heroicon-o-phone')
                                ->schema([
                                    Repeater::make('partners')
                                        ->label("Список")
                                        ->schema([
                                             CuratorPicker::make('image_id')
                                                ->label('Логотип')
                                                ->buttonLabel('Из медиатеки')
                                                ->color('primary')
                                                ->preserveFilenames()
                                                ->constrained(false),

                                            TextInput::make('url')->label('Ссылка'),
                                        ])
                                        ->itemLabel(fn(array $state): ?string => $state['url'] ?? 'Новый пункт')
                                        ->columns(3)
                                        ->collapsed()

                                ]),
                        ])->columnSpanFull(),

                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Сохранить')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach (collect($data)->except('menu') as $name => $content) {
            ModelsMainOption::updateOrCreate(['name' => $name], ['content' => $content]);
        }

        if (isset($data['menu'])) {
            foreach ($data['menu'] as $menuItem) {
                $type = $menuItem['type'];
                $items = $menuItem['items'] ?? [];

                ModelsMainOption::updateOrCreate(
                    ['name' => $type],
                    ['content' => ['items' => $items]]
                );
            }
        }


        Notification::make()->title('Настройки сохранены')->success()->send();
    }
}
