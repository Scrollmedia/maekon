<?php

namespace App\Traits;

use App\Http\Resources\Portfolio\PortfolioMiniResource;
use App\Http\Resources\Posts\PostMiniResource;
use App\Http\Resources\Services\ServiceCategoryResource;
use Awcodes\Curator\Models\Media as CuratorMedia;

trait EnrichesContentBlocks
{
    /**
     * Универсальный метод для обработки блоков в любом ресурсе
     */
    protected function enrichBlocks(array $blocks, $mediaMap, $globalOptions = null,  $otherData = null): array
    {
        return collect($blocks)->map(function ($block) use ($mediaMap, $globalOptions,  $otherData) {
            $type = $block['type'];
            $data = $block['data'] ?? [];

            // Примешиваем глобальный контент, если передан
            if ($globalOptions && isset($globalOptions[$type])) {
                $data['global_content'] = $globalOptions[$type]->value;
            }

            $map = [
                'brand' => fn($items) => $this->itemsMap($items, $mediaMap),
                'brand_main' => fn($items) => $this->itemsMap($items, $mediaMap),
                'news'  => fn($items) => $this->itemsMap($items, $mediaMap),
                'news_main'  => fn($items) => $this->itemsMap($items, $mediaMap),
                'direction' => fn($items) => $this->itemsMap($items, $mediaMap),
                'direction_main' => fn($items) => $this->itemsMap($items, $mediaMap),
            ];

            if ($otherData && isset($map[$type]) && isset($otherData[$type])) {
                $data['items'] = $map[$type]($otherData[$type])->toArray();
            }

            // Заменяем все image_id на объекты медиа
            $data = $this->processRecursiveMedia($data, $mediaMap);

            return [
                'type' => $type,
                'data' => $data,
            ];
        })->toArray();
    }

    protected function itemsMap($items, $mediaMap){
        return $items->map(fn($p) => [
                        'id'    => $p->id,
                        'title' => $p->title,
                        'slug'  => $p->urlRegistry?->slug ?? '#', 
                        'excerpt'  => $p->excerpt,
                        'preview' => isset($mediaMap[$p->preview]) ? [
                            'url' => $mediaMap[$p->preview]->url,
                            'alt' => $mediaMap[$p->preview]->alt,
                        ] : null,
                        'created_at' => $p->created_at ?? ''
                    ]);
    }
    /**
     * Рекурсивная замена image_id на объекты медиа
     */
    protected function processRecursiveMedia($data, $mediaMap)
    {
        if (!is_array($data)) return $data;

        foreach ($data as $key => &$value) {
            if ($key === 'image_id' && isset($mediaMap[$value])) {
                $media = $mediaMap[$value];
                $value = [
                    'url' => $media->url,
                    'alt' => $media->alt,
                ];
            }
            elseif ($key === 'file' && isset($mediaMap[$value])) {
                $media = $mediaMap[$value];
                
                // Формируем детальный объект файла для вывода в Blade
                $value = [
                    'url'       => $media->url,
                    'name'      => $media->name ?? basename($media->url),
                    'extension' => $media->extension ?? pathinfo($media->url, PATHINFO_EXTENSION),
                    'size'      => $media->size_formatted ?? $this->formatBytes($media->size ?? 0), // Красивый размер (н-р: "2.4 MB")

                    //'width'     => $media->width ?? null,
                    //'height'    => $media->height ?? null,
                ];
            } 
            elseif (is_array($value)) {
                $value = $this->processRecursiveMedia($value, $mediaMap);
            }
        }
        return $data;
    }

    protected function formatBytes($bytes, $precision = 1): string
    {
        if ($bytes <= 0) return '0 B';
        
        $base = log($bytes, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

        $index = (int) floor($base); 
        
        $index = min($index, count($suffixes) - 1);

        return round(pow(1024, $base - $index), $precision) . ' ' . $suffixes[$index];
    }

    /**
     * Сбор всех image_id из массива блоков (для подготовки mediaMap)
     */
    protected function collectImageIdsFromBlocks(array $blocks): array
    {
        $ids = [];
        array_walk_recursive($blocks, function ($value, $key) use (&$ids) {
            if (($key === 'image_id' || $key === 'file') && $value) $ids[] = $value;
        });
         return array_unique($ids);
    }
}
