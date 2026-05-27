<?php

namespace App\Services;

use App\Interfaces\BreadcrumbsInterface;
use App\Models\Brand;
use App\Models\Direction;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class BreadcrumbsService {
      public function build(Model $model): array {

        $crumbs = [['label' => 'Главная', 'url' => '/']];
 
        if (!$model instanceof BreadcrumbsInterface) {
            return $crumbs;
        }

        return match (true) {
            $model instanceof Direction => $this->forDirection($model, $crumbs),
            $model instanceof Brand => $this->forBrand($model, $crumbs),
            $model instanceof Page    => $this->forPage($model, $crumbs),
            default   => $this->forPage($model, $crumbs)
        };
    }
 
        private function forDirection(object $model,array $crumbs)
    {
        $main = $this->getMainPageByTemplate('directions');

        if ($main) $crumbs[] = $this->makeCrumb($main);
 
        if ($model->category) {
            $crumbs = array_merge($crumbs, $this->getAncestors($model->category));
        }
 
        $crumbs[] = $this->makeLastCrumb($model);
        return $crumbs;
    }

        private function forBrand(object $model,array $crumbs)
    {
        $main = $this->getMainPageByTemplate('brands');

        if ($main) $crumbs[] = $this->makeCrumb($main);
 
        if ($model->category) {
            $crumbs = array_merge($crumbs, $this->getAncestors($model->category));
        }
 
        $crumbs[] = $this->makeLastCrumb($model);
        return $crumbs;
    }


    private function forPage(object $model,array $crumbs)
    {

        $crumbs = array_merge($crumbs, $this->getAncestors($model));
        $crumbs[] = $this->makeLastCrumb($model);
        return $crumbs;
    }

    private function getAncestors(BreadcrumbsInterface $model): array
    {
        $ancestors = [];
        $parent = $model->getBreadcrumbParent();

        while ($parent) {
           
            array_unshift($ancestors, $this->makeCrumb($parent));
            $parent = $parent->getBreadcrumbParent();
        }

        return $ancestors;
    }

    private function makeCrumb(BreadcrumbsInterface $entity): array
    {
        return [
            'label' => $entity->getBreadcrumbLabel(),
            'url'   => $entity->getBreadcrumbUrl()
        ];
    }

    private function makeLastCrumb(BreadcrumbsInterface $entity): array
    {
        return [
            'label' => $entity->getBreadcrumbLabel(),
            'url'   => null
        ];
    }


    private function getMainPageByTemplate(string $template)
    {
        return once(fn() => Page::where('template', $template)->first());
    }
    
}