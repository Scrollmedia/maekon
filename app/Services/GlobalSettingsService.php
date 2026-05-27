<?

namespace App\Services;

use App\Models\MainOption;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Traits\EnrichesContentBlocks;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GlobalSettingsService
{
    use EnrichesContentBlocks;
    public function getFullConfig()
    {
 
            $menuKeys = ['main_menu', 'footer_menu'];

            $allOptions = MainOption::all()->keyBy('name');
 
             $options = collect($menuKeys)->mapWithKeys(fn($key) => [$key => $allOptions->get($key)])->filter();
 
             $globalConfigs = $allOptions->except($menuKeys)->pluck('content', 'name');
 
             $items = $options->flatMap(fn($menu) => $menu->content['items'] ?? []);

            $pageIds = $items->where('type', 'page')->pluck('page_id')->unique()->filter();

            $pages = Page::whereIn('id', $pageIds)->get(['id', 'slug'])->keyBy('id');

            $result = $globalConfigs->toArray();

             foreach ($menuKeys as $key) {
                $option = $options->get($key);
 
                $menuItems = $option->content['items'] ?? [];

                $result[$key] = array_map(function ($item) use ($pages) {
                    $url = '#';
                    $type = $item['type'] ?? 'custom';

                    if ($type === 'page') {
                        $url = isset($pages[$item['page_id']]) ? '/' . $pages[$item['page_id']]->slug : '#';
                    } else {
                        $url = $item['custom_url'] ?? '#';
                    }

                    return [
                        'label' => $item['label'] ?? '',
                        'url'   => $url,
                    ];
                }, $menuItems);
            }
             
           $logoId = $globalConfigs->get('logo');
            if ($logoId) {
                $media = Media::find($logoId); // Один быстрый запрос по Primary Key
                $result['logo'] = $media ? [
                    'url' => $media->url,
                    'alt' => $media->alt
                ] : null;
            } else {
                $result['logo'] = null; // Всегда возвращаем ключ для фронта
            }

            $partners = $globalConfigs->get('partners');

            if (!empty($partners)) {
                $imageIds = $this->collectImageIdsFromBlocks($partners);

                if (!empty($imageIds)) {
                    $mediaMap = Media::whereIn('id', $imageIds)
                        ->get()->keyBy('id');

                    $result['partners'] = $this->processRecursiveMedia($partners, $mediaMap);
                } else {
                    $result['partners'] = $partners;
                }
            } else {
                $result['partners'] = [];
            }

            return $result;
 
    }
}
