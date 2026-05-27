<?php

namespace App\Filament\Widgets;

use Filament\Notifications\Notification;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class QuickActions extends StatsOverviewWidget
{
    protected  string $view = 'filament.widgets.quick-actions';

    protected int | string | array $columnSpan = 1;

    public function clearCache()
    {
        // Выполняем системные команды
        Cache::tags(['pages', 'posts', 'settings', 'content'])->flush();

        Artisan::call('optimize:clear');

        // Выводим уведомление в админку
        Notification::make()
            ->title('Кэш успешно очищен!')
            ->success()
            ->send();
    }
}
