<?php

namespace App\Filament\Widgets;

use App\Models\Brand;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BrandStats extends StatsOverviewWidget
{
    protected static ?int $sort = 6;
    protected function getStats(): array
    {
        return [
            Stat::make('Всего брендов', Brand::count())
                ->description('Общее количество в базе')
                ->icon('heroicon-o-briefcase'),

            Stat::make(
                'Новых за месяц',
                Brand::where('created_at', '>=', now()->subMonth())->count()
            )
                ->description('Добавлено за последние 30 дней')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Пример фейкового мини-графика

            Stat::make(
                'Новых за 6 месяцев',
                Brand::where('created_at', '>=', now()->subMonths(6))->count()
            )
                ->description('Добавлено за последние 180 дней')
                ->color('info'),


        ];
    }
}
