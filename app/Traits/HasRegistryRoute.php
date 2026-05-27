<?php

namespace App\Traits;

use App\Jobs\UpdateRegistryJob;
use App\Models\ServiceCategory;
use App\Models\UrlRegistry;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 * @property int $id
 * @property string $slug
 * @method \Illuminate\Database\Eloquent\Relations\MorphOne morphOne($related, $name)
 * @method static void saved(\Closure $callback)
 * @method static void deleted(\Closure $callback)
 */

trait HasRegistryRoute
{
    //  автоматически при загрузке трейта в модели
    protected static function bootHasRegistryRoute()
    {

        static::saved(function ($model) {
            
            $model->updateRegistry();

            $model->clearContentCache();
            
            $model->refreshChildrenRoutes(); 
        });

        static::deleted(function ($model) {
            $model->registryRecord()->delete();
            $model->clearContentCache();
        });
    }

    public function clearContentCache()
    {
        // Очищаем все записи с тегами 'pages' и 'content'
        //Cache::tags(['pages', 'content'])->flush();
    }

    public function refreshChildrenRoutes()
    {
        // Список отношений, которые могут зависеть от слага этой модели
        // Можно определить в самой модели, например: protected $touchLinks = ['categories', 'services']
        $relations = property_exists($this, 'registryRelations')
            ? $this->registryRelations
            : [];

        foreach ($relations as $relation) {
            if (method_exists($this, $relation)) {

                $this->$relation()->get()->each(function ($child) {
                    $child->updateRegistry();

                    if (method_exists($child, 'refreshChildrenRoutes')) {
                        $child->refreshChildrenRoutes();
                    }
                });
            }
        }
    }

    public function registryRecord()
    {
        return $this->morphOne(UrlRegistry::class, 'model');
    }

    public function updateRegistry()
    {
        $this->registryRecord()->updateOrCreate(
            ['model_id' => $this->id, 'model_type' => get_class($this)],
            [
                'slug' => $this->generateFullSlug(),
                'handler' => $this->getHandlerClass(),
            ]
        );
    }

    // Логика сборки пути (переопредели в моделях, если нужно)
    protected function generateFullSlug(): string
    {
        // Базовая логика: если есть родитель, приклеиваем его слаг
        // Например, для услуги: $this->category->slug . '/' . $this->slug
        return $this->slug;
    }

    // Каждый класс сам скажет, какой хендлер его обслуживает
    abstract protected function getHandlerClass(): string;
}
