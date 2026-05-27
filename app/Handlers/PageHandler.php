<?php

namespace App\Handlers;

use App\Http\Resources\PageResource;

use App\Interfaces\SlugHandlerInterface;
use App\Models\Page;
use App\Services\PageService;

class PageHandler implements SlugHandlerInterface {
    /* public function find(string $slug) {
        return Page::with('seo')->where('slug', $slug)->first();
    } */

    public function getBladeData($model) {
        return app(PageService::class)->GetPageData($model);
    }
}