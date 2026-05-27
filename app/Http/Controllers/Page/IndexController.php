<?

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\MainOption;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Services\BreadcrumbsService;
use App\Services\GetOtherPagesService;
use App\Services\PageService;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __invoke(PageService $pageService)
    {
            $page = Page::with('seo')->where('slug', 'main')->firstOrFail();

            $data = $pageService->GetPageData($page);
        
           // $breadcrumbs = app(BreadcrumbsService::class)->build($page);
          
            return view('pages.main', [
                'page' => $page,
                'blocks' => $data,
               // 'breadcrumbs' => $breadcrumbs,
            ]);
 
    }
}