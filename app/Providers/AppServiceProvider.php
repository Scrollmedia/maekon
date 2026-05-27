<?php

namespace App\Providers;

use App\Services\GlobalSettingsService;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Laravel\Facades\Image;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public static $isProcessing = false;

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Media::creating(function ($media) {

            if (static::$isProcessing)
                return;

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (str_contains($media->type, 'image') && in_array(strtolower($media->ext), $allowedExtensions)) {

                static::$isProcessing = true; // Ставим заслонку

                try {
                    $storage = Storage::disk($media->disk);
                    $tempSourcePath = $media->path;

                    $pathInfo = pathinfo($tempSourcePath);
                    $dir = ($pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/');
                    $originalPath = $dir . 'originals/' . $pathInfo['basename'];
                    $webpPath = $dir . $pathInfo['filename'] . '.webp';

                    if (!$storage->exists($dir . 'originals')) {
                        $storage->makeDirectory($dir . 'originals');
                    }
                    $storage->copy($tempSourcePath, $originalPath);


                    DB::table('curator')->insert([
                        'disk' => $media->disk,
                        'directory' => $dir . 'originals/',
                        'visibility' => 'public',
                        'name' => $media->name,
                        'path' => $originalPath,
                        'ext' => $pathInfo['extension'],
                        'type' => $media->type,
                        'size' => $storage->size($originalPath),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                    $imageStream = Image::read($storage->path($tempSourcePath))->toWebp(85);
                    $storage->put($webpPath, (string) $imageStream);


                    $media->path = $webpPath;
                    $media->ext = 'webp';
                    $media->type = 'image/webp';
                    $media->size = $storage->size($webpPath);


                    $storage->delete($tempSourcePath);

                } catch (\Exception $e) {
                    Log::error("Media Processing Error: " . $e->getMessage());
                } finally {
                    static::$isProcessing = false;
                }
            }
        });


        View::composer('*', function ($view) {
            $settings = app(GlobalSettingsService::class)->getFullConfig();

            $view->with('globalSettings', $settings);
        });
    }
}
