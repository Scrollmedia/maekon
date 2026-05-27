<?php

use App\Http\Controllers\Page\IndexController;
use App\Http\Controllers\Page\RouteResolverController;
use Illuminate\Support\Facades\Route;

 
 

 

Route::get('/{slug?}', [RouteResolverController::class, 'resolve'])->where('slug', '.*')->name('page.show');