<?php

namespace App\Models;

use App\Handlers\PostsHandler;
use App\Interfaces\BreadcrumbsInterface;
use App\Interfaces\HasBlocksInterface;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRegistryRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use LaravelLang\Models\HasTranslations;


class Post extends Model implements BreadcrumbsInterface, HasBlocksInterface
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
        return  PostsHandler::class;
    }

    protected function generateFullSlug(): string 
    {


        $mainPage = once(fn() => Page::where('template', 'news')->first());
        $prefix = $mainPage ? $mainPage->slug : 'blog';

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
