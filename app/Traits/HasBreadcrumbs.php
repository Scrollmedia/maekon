<?php

namespace App\Traits;

use App\Interfaces\BreadcrumbsInterface;

trait HasBreadcrumbs
{
    public function getBreadcrumbLabel(): string
    {
        return $this->title ?? $this->name ?? 'Без названия';
    }

    public function getBreadcrumbUrl(?string $prefix = null): string
    {
        // Предполагаем, что связь называется registryRecord
        if (method_exists($this, 'registryRecord') && $this->registryRecord) {
            return '/' . ltrim($this->registryRecord->slug, '/');
        }

        return '/' . ltrim($this->slug ?? '', '/');
    }

    public function getBreadcrumbParent(): ?BreadcrumbsInterface
    {
        return $this->parent ?? $this->category ?? null;
    }
 
}
