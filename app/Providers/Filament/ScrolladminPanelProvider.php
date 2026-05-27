<?php

namespace App\Providers\Filament;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\CuratorPlugin;
use Awcodes\Curator\Models\Media;
use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
 
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Tiptap\Nodes\Paragraph;

class ScrolladminPanelProvider extends PanelProvider
{

 
 

    public function panel(Panel $panel): Panel
    {
        RichEditor::configureUsing(function (RichEditor $editor) {
 

              

        $editor->toolbarButtons([
                                ['clearFormatting'],
                                [ToolbarButtonGroup::make('Форматирование',['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'])->icon('heroicon-o-pencil-square') ],
                                [ToolbarButtonGroup::make('Текст', ['h1','h2', 'h3','h4','h5','paragraph','small'])->icon('fi-o-heading')],
                                [ToolbarButtonGroup::make('Alignment', ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'])->icon('heroicon-o-bars-3-bottom-left')],
                                 
                                ['textColor'  ], 
                                ['codeBlock', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'], 
                                ['undo', 'redo', 'source-code'],
                            ]);
                 $editor->customTextColors();
 
                 $editor->hintAction( 
                                Action::make('openCurator')
                                    ->label('Выбрать из медиатеки')
                                    ->icon('heroicon-m-photo')
                                    ->color('primary')
                                    ->form([
                                        CuratorPicker::make('temp_image')
                                            ->label('Выберите изображение')
                                            ->required(),
                                    ])
                                    ->action(function (array $data, $component) {
                                        $media = Media::find($data['temp_image']);

                                        if ($media) {
                                            $imageUrl = $media->url;
                                            $altText = $media->alt ?? '';
                                            $component->getLivewire()->dispatch(
                                                'insert-content-into-rich-editor',
                                                statePath: $component->getStatePath(),
                                                content: "<img src=\"{$imageUrl}\" alt=\"{$altText}\" />",
                                            );
                                        }
                                    })
                           );
        });
 
        return $panel
            ->default()
            ->id('scrolladmin')
            ->path('scrolladmin')
            ->viteTheme('resources/css/filament/scrolladmin/theme.css')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])

 
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            
            ->plugins([
                FilamentShieldPlugin::make()
                    ->navigationGroup('Юзеры'),
                CuratorPlugin::make()
                    ->label('Медиатека')
                    ->pluralLabel('Медиатека')
                    ->navigationGroup('Контент')
                    ->navigationIcon('heroicon-o-photo')
                

            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Направления'),

                NavigationGroup::make()
                    ->label('Бренды'),

                NavigationGroup::make()
                    ->label('Юзеры'),
 
                NavigationGroup::make()
                    ->label('Контент')
            ])
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn(): string => Blade::render(<<<HTML
                <script>
                       document.addEventListener('livewire:init', () => {
                        Livewire.on('insert-content-into-rich-editor', (event) => {
                            // Поддержка разных форматов передачи данных в Livewire v3
                            const data = Array.isArray(event) ? event[0] : (event.detail || event);
                            const { statePath, content } = data;

                            // Ищем элемент, у которого в x-data есть наш statePath
                            const container = document.querySelector(`[x-data*="statePath: '\${statePath}'"]`);

                            if (container) {
 
                                const editorElement = container.querySelector('[x-ref="editor"]');
                                
                                if (editorElement) {
                                    const alpineData = Alpine.\$data(editorElement);
                                    const tiptap = alpineData.editor // Стандарт Filament
                                    || (alpineData.instance ? alpineData.instance() : null) 
                                    || (alpineData.getEditor ? alpineData.getEditor() : null);
                                    
                                     if (tiptap) {
                                        tiptap.chain().focus().insertContent(content).run();
                                    } else {
                                        // Если редактор еще не готов, пробуем через встроенный метод Filament
                                        // В некоторых версиях работает прямой вызов через Alpine
                                        try {
                                            alpineData.insertContent(content);
                                        } catch (e) {
                                            console.error('Tiptap не инициализирован или недоступен', alpineData);
                                        }
                                    }
                                }
                            } else {
                                console.error('Контейнер не найден для: ' + statePath);
                            }
                        });
                    });

                </script>
            HTML),

            );
 
    }
}
