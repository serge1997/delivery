<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PromotionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(PromotionController::class)->group(function() {
    Route::prefix('v1/promotion')->name('promotion.')->group(function () {
        Route::post('/', 'onCreate')->name('create');
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'onUpdate')->name('update');
        Route::put('/status/{id}', 'onHandleUpdateIsActive')->name('updatestatus');
    });
});

Route::controller(CategoryController::class)->group(function(){
    Route::prefix('v1/category')->name('category.')->group(function () {
        Route::post('/', 'store')->name('store');
        Route::get('/', 'index')->name('index');
    });
});
