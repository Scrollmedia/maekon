<?php

namespace App\Http\Controllers;

use App\Models\MainOption;
use App\Services\GlobalSettingsService;

 class SettingsController extends Controller
{
    public function __invoke(GlobalSettingsService $service)
    {
        return response()->json($service->getFullConfig());
    }
 
}

