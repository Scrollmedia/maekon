<?php

namespace App\Models;

use App\Handlers\PageHandler;
use App\Interfaces\BreadcrumbsInterface;
use App\Interfaces\HasBlocksInterface;
use App\Traits\HasBreadcrumbs;
use App\Traits\HasRegistryRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use LaravelLang\Models\HasTranslations;


class Page extends Model implements BreadcrumbsInterface, HasBlocksInterface
{
    use HasFactory, HasRegistryRoute, HasBreadcrumbs;
    protected $guarded = [];

    protected $casts = [
        'content_blocks' => 'array',
        'static_content' => 'array',
    ];

    protected $registryRelations = ['categories'];



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

    public function getContentBlocks(): array
    {
        return $this->content_blocks ?? [];
    }
 
}
