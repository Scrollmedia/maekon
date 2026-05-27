<?php

namespace App\Models;

use App\Handlers\BrandHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\BreadcrumbsInterface;
use App\Interfaces\HasBlocksInterface;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRegistryRoute;
use LaravelLang\Models\HasTranslations;


class Brand extends Model implements BreadcrumbsInterface, HasBlocksInterface
{
    use HasFactory, HasRegistryRoute, HasBreadcrumbs;
     protected $guarded = [];

     protected $sortable = ['sort_order'];
     
     protected $casts = [
        'content_blocks' => 'array',   
     ];


     public function getRouteKeyName(){
        return 'slug';
     }

         public function seo()
    {
        return $this->hasOne(Seo::class);
    }
 
    
    protected function getHandlerClass(): string
    {
        return BrandHandler::class;
    }

    protected function generateFullSlug(): string 
    {


        $mainPage = once(fn() => Page::where('template', 'brands')->first());
        $prefix = $mainPage ? $mainPage->slug : 'brands';

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
