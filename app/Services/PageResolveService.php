<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\UrlRegistry;

class PageResolveService {
  
        public function resolve(string $slug) {
 
            $route = UrlRegistry::with(['model.seo'])->where('slug', $slug)->first();

            if (!$route || !$route->model) {
                return null;
            }

                      
            $handler = app($route->handler);

 
            $blocks = $handler->getBladeData($route->model);
 
            $modelClass = get_class($route->model); 
            
            $defaultTemplatesModels = [
                'App\Models\Direction',
                'App\Models\Brand',
                'App\Models\Post',
            ];

            if (in_array($modelClass, $defaultTemplatesModels)) {
                $viewTemplate = 'default';
            } else {
                $viewTemplate = ($route->model->template ?? 'default');
            }

            if (!view()->exists($viewTemplate)) {
                $viewTemplate = 'default';
            }

            return (object) [
                'model_type' => $route->model_type,
                'model' => $route->model,
                'blocks'  => $blocks,
                'template'   => $viewTemplate
            ];
        }
  
}
