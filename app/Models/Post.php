<?php

namespace App\Models;
use App\Interfaces\BreadcrumbsInterface;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRegistryRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use LaravelLang\Models\HasTranslations;


class Post extends Model implements BreadcrumbsInterface
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
        return  PageHandler::class;
    }

    protected function generateFullSlug(): string
    {
        return  $this->slug;
    }

}
