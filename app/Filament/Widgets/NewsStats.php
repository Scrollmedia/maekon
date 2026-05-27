<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewsStats extends StatsOverviewWidget
{
    
    protected int | string | array $columnSpan = '1';
    protected static ?int $sort = 4;
    protected function getStats(): array
    {
        return [
            Stat::make('Всего новостей', Post::count())
                ->chart([17, 14, 18, 13, 15, 14, 17])
                ->description('Общее количество в базе')
                ->icon('heroicon-o-newspaper'),
        ];
    }
    protected function getColumns(): int
    {
        return 1;
    }
}
