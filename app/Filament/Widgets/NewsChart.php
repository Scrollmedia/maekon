<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class NewsChart extends ChartWidget
{
    protected ?string $heading = 'Новости график';

    protected int | string | array $columnSpan = '2';

    protected ?string $maxHeight = '400px';
    protected static ?int $sort = 5;
    protected function getData(): array
    {
          $data = Post::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->where('created_at', '>=', now()->subYear())
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Новости по месяцам',
                    'data' => $data->values()->toArray(),
                ],
            ],
            'labels' => ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
