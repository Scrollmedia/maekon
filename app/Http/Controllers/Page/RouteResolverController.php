<?php

namespace App\Http\Controllers\Page;

use App\Services\BreadcrumbsService;
use App\Services\PageResolveService;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RouteResolverController
{

    public function resolve(PageResolveService $resolver,$slug = null)
    {
 
            
            $slug = $slug ? trim($slug, '/') : 'main';
            
            if ($slug === '') {
                $slug = 'main';
            }
            
            $result = $resolver->resolve($slug);

            if (!$result) abort(404);
 
           
            $breadcrumbs = app(BreadcrumbsService::class)->build($result->model);

            
            return view('pages.main', [
                'template' => $result->template,
                'page' => $result->model,
                'blocks' => $result->blocks,
                'breadcrumbs' => $breadcrumbs,
            ]);
 
    }
}
