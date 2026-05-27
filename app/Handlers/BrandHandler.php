<?php

namespace App\Handlers;

use App\Http\Resources\PageResource;
use App\Interfaces\SlugHandlerInterface;
use App\Models\Brand;
use App\Services\PageService;

class BrandHandler implements SlugHandlerInterface {
 /* public function find(string $slug) {
        return Brand::with('seo')->where('slug', $slug)->first();
    } */

    public function getBladeData($model) {
        return app(PageService::class)->GetPageData($model);
    }
}