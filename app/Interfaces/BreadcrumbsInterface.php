<?php

namespace App\Interfaces;

interface BreadcrumbsInterface
{
    public function getBreadcrumbLabel(): string;
    public function getBreadcrumbUrl(?string $prefix = null): string;

    public function getBreadcrumbParent(): ?BreadcrumbsInterface;
}
