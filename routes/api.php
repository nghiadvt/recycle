<?php

use App\Http\Controllers\Api\Admin\AreaController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DamagedMissingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\GarbageTypeController;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\LanguageController;
use App\Http\Controllers\Api\Admin\MissendReportController;
use App\Http\Controllers\Api\Admin\ReportController;
use App\Http\Controllers\Api\Admin\ContainerGarbageTypeController;
use App\Http\Controllers\Api\Admin\UserGarbageTypeController;
use App\Http\Controllers\Api\Admin\ReportAppController;
use App\Http\Controllers\Api\Admin\PrefectureController;
use App\Http\Controllers\Api\Admin\ServiceGarbageController;
use App\Http\Controllers\Api\Admin\ServiceGarbageTypeController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\ServiceArticleController;
use App\Http\Controllers\Api\Admin\ScheduleController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\Admin\ServiceCategoryController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\TermOfServiceController;
use App\Http\Controllers\Api\Admin\PageController;
use App\Http\Controllers\Api\ReportPlaceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::middleware(['auth.admin'])->group(function () {


        Route::resource('categories', CategoryController::class);
        Route::post('categories/update-icon/{id}', [CategoryController::class, 'update_icon']);


        Route::post('/logout', [LoginController::class, 'logout']);
        Route::resource('languages', LanguageController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('service-garbages', ServiceGarbageController::class);
        Route::resource('garbage-types', GarbageTypeController::class);
        Route::get('service-garbage/parents', [ServiceGarbageController::class, 'getServiceGarbageParents']);
        Route::resource('service-garbage-types', ServiceGarbageTypeController::class);
        Route::resource('garbage-types', GarbageTypeController::class);
        Route::get('garbage-types-active', [GarbageTypeController::class, 'getGarbageTypeActive']);
        Route::prefix('garbage-types')->group(function () {
            Route::controller(GarbageTypeController::class)->group(function () {
                Route::post('update-image/{id}', 'updateIcon');
            });
        });
        Route::post('garbage-types/update-image/{id}', [GarbageTypeController::class, 'updateIcon']);
        Route::resource('schedules', ScheduleController::class);
        Route::get('schedule/areas', [AreaController::class, 'getAllAreas']);
        Route::get('schedule/search/areas', [SearchController::class, 'search']);
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('prefectures', PrefectureController::class);
        Route::resource('service-articles', ServiceArticleController::class);
        Route::post('services/update-image/{id}', [ServiceController::class, 'updateImage']);
        Route::resource('services', ServiceController::class);
        Route::resource('pages', PageController::class);
        Route::resource('container-garbage-types', ContainerGarbageTypeController::class);
        Route::post('container-garbage-types/update-container/{id}', [ContainerGarbageTypeController::class, 'update_container']);

    });
});

Route::prefix('/')->group(function () {
    Route::get('search', [SearchController::class, 'search']);
    Route::get('calendar/{areaId}', [CalendarController::class, 'index']);
    Route::prefix('information')->group(function () {
        Route::controller(InformationController::class)->group(function () {
            Route::get('garbage-types', 'getGarbageTypes');
            Route::get('service-garbages', 'getServiceGarbage');
        });
        Route::resource('categories-service-garbages', InformationController::class);
    });
    Route::prefix('more')->group(function () {
        Route::controller(TermOfServiceController::class)->group(function () {
            Route::get('terms-of-service', 'index');
            Route::get('privacy-policy', 'getPrivacyPolicy');
        });
    });
    Route::get('garbage-types', [GarbageTypeController::class, 'getGarbageTypeActive']);
    Route::post('place-reports', [ReportPlaceController::class, 'store']);
});

Route::resource('missend-reports', MissendReportController::class);
Route::resource('reports', ReportController::class);
Route::get('container-garbage-types', [ContainerGarbageTypeController::class, 'index']);
Route::resource('damaged-missing-reports', DamagedMissingController::class);
Route::resource('user-garbage-types', UserGarbageTypeController::class);
Route::resource('report-apps', ReportAppController::class)->middleware('checkAge');
