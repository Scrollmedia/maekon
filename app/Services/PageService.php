<?php

namespace App\Services;

use App\Http\Resources\PageResource;
use App\Http\Resources\Portfolio\PortfolioMiniResource;
use App\Http\Resources\Posts\PostMiniResource;
use App\Http\Resources\Services\ServiceCategoryResource;
use App\Interfaces\HasBlocksInterface;
use App\Models\Page;
use App\Models\ServiceCategory;
use App\Traits\EnrichesContentBlocks;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Cache;

class  PageService
{
    use EnrichesContentBlocks;
    public function GetPageData(HasBlocksInterface $model)
    {

 
        $foundTypes = collect($model->getContentBlocks())->pluck('type')->unique();


        $otherData = [
            'brand_main' => $foundTypes->contains('brand_main') ? GetOtherPagesService::getAllBrands() : collect(),
            'brand' => $foundTypes->contains('brand') ? GetOtherPagesService::getHomeBrands() : collect(),
            'news' => $foundTypes->contains('news') ? GetOtherPagesService::getHomeNews() : collect(),
            'news_main' => $foundTypes->contains('news_main') ? GetOtherPagesService::getAllNews() : collect(),
            'direction' => $foundTypes->contains('direction') ? GetOtherPagesService::getHomeDirections() : collect(),
            'direction_main' => $foundTypes->contains('direction_main') ? GetOtherPagesService::getAllDirections() : collect(),

        ];

 
        $allImageIds = collect([$this->collectImageIdsFromBlocks($model->getContentBlocks() ?? [])])
            ->concat(collect($otherData)->map(fn($items) => $items->pluck('preview')))
            ->flatten()
            ->filter()
            ->unique()
            ->toArray();

        $mediaMap = Media::whereIn('id', $allImageIds)->get()->keyBy('id');

         
        $enrichedBlocks = $this->enrichBlocks($model->getContentBlocks() ?? [], $mediaMap, null,  $otherData);




        return $enrichedBlocks;
    }
}
