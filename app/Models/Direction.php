<?php

namespace App\Models;

use App\Handlers\DirectionsHandler;
use App\Handlers\ServiceItemHandler;
use App\Interfaces\BreadcrumbsInterface;
use App\Interfaces\HasBlocksInterface;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRegistryRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelLang\Models\HasTranslations;


class Direction extends Model implements BreadcrumbsInterface, HasBlocksInterface
{
    use HasFactory, HasRegistryRoute, HasBreadcrumbs;
    protected $guarded = [];

    protected $casts = [
        'content_blocks' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

 
    public function seo()
    {
        return $this->hasOne(Seo::class);
    }



    protected function getHandlerClass(): string
    {
        return DirectionsHandler::class;
    }

    protected function generateFullSlug(): string 
    {


        $mainPage = once(fn() => Page::where('template', 'directions')->first());
        $prefix = $mainPage ? $mainPage->slug : 'directions';

        return $prefix . '/' . $this->slug;
    }

        public function getContentBlocks(): array
    {
        return $this->content_blocks ?? [];
    }
    public function urlRegistry()
    {
        return $this->morphOne(UrlRegistry::class, 'model');
        
    }

   
}
