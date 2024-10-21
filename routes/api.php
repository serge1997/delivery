<?php

use App\Http\Controllers\Api\V1\AuthRestaurantController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\FoodTypeController;
use App\Http\Controllers\Api\V1\PromotionController;
use App\Http\Controllers\Api\V1\RestaurantController;
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
        Route::get('/actives', 'listAllActives')->name('listall.actives');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'onUpdate')->name('update');
        Route::put('/status/{id}', 'onHandleUpdateIsActive')->name('updatestatus');
    });
});

Route::controller(CategoryController::class)->group(function(){
    Route::prefix('v1/category')->name('category.')->group(function () {
        Route::post('/', 'store')->name('store');
        Route::get('/', 'index')->name('index');
        Route::get('/actives', 'listAllActives')->name('listall.actives');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'update')->name('update');
        Route::post('/update/image', 'updateImage')->name('update.image');
        Route::put('/status/{id}','updateIsActive')->name('update.status');
    });
});

Route::controller(FoodTypeController::class)->group(function(){
    Route::prefix('v1/food-type')->name('food.type.')->group(function(){
        Route::post('/', 'store')->name('store');
        Route::get('/', 'index')->name('index');
        Route::get('/actives', 'listAllActives')->name('listall.actives');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'update')->name('update');
        Route::put('/status/{id}', 'handleIsActive')->name('update.status');
    });
});

Route::controller(RestaurantController::class)->group(function() {
    Route::prefix('v1/restaurant')->name('restaurant.')->group(function(){
        Route::post('/', 'store')->name('store');
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'update')->name('update');
    });
});

Route::controller(AuthRestaurantController::class)->group(function() {
    Route::prefix('v1/auth-restaurant')->name('auth,restaurant')->group(function(){
        Route::post('/auth', 'login')->name('login');
    });
});
