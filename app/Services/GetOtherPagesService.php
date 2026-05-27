<?

namespace App\Services;

use App\Models\Brand;
use App\Models\Direction;
use App\Models\MainOption;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Cache;

class  GetOtherPagesService
{
 
     
    public static function getHomeBrands() {
        return Brand::where('publish', true)
            ->select(['id', 'title',  'excerpt', 'preview'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id', 'model_type']);
            }])
            ->limit(6)->get();
    }
    public static function getAllBrands() {
        return Brand::where('publish', true)
            ->select(['id', 'title',  'excerpt', 'preview'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id', 'model_type']);
            }])
            ->get();
    }

    public static function getHomeNews() {
        return Post::where('publish', true)
            ->select(['id', 'title', 'excerpt',  'preview', 'created_at'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id', 'model_type']);
            }])
            ->limit(6)->get();
    }
    public static function getAllNews() {
        return Post::where('publish', true)
            ->select(['id', 'title', 'excerpt',  'preview', 'created_at'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id', 'model_type']);
            }])->get();
    }

    public static function getHomeDirections() {
        return Direction::select(['id', 'title','preview', 'excerpt'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id', 'model_type']);
            }])
            ->limit(6)->get();
    }
    public static function getAllDirections() {
        return Direction::select(['id', 'title','preview', 'excerpt'])
            ->with(['urlRegistry' => function ($query) {
                $query->select(['slug', 'model_id',  'model_type']);
            }])->get();
    }
 


}