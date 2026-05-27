<?php

namespace App\Handlers;

use App\Http\Resources\PageResource;
use App\Interfaces\SlugHandlerInterface;
use App\Models\Brand;
use App\Models\Direction;
use App\Services\PageService;

class PostsHandler implements SlugHandlerInterface {
    /* public function find(string $slug) {
        return Direction::with('seo')->where('slug', $slug)->first();
    } */

    public function getBladeData($model) {
        return app(PageService::class)->GetPageData($model);
    }
}