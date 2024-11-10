<?php

use App\Http\Controllers\Api\V1\AuthRestaurantController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\FoodTypeController;
use App\Http\Controllers\Api\V1\MenuitemController;
use App\Http\Controllers\Api\V1\PromotionController;
use App\Http\Controllers\Api\V1\RestaurantCategoryController;
use App\Http\Controllers\Api\V1\RestaurantController;
use App\Http\Controllers\Api\V1\RestaurantFoodTypeController;
use App\Http\Controllers\Api\V1\SideDishController;
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

Route::middleware(['auth:sanctum', 'type.restaurant'])->group(function () {

    Route::controller(SideDishController::class)->group(function(){
        Route::prefix('v1/side-dish')->name('sidedish.')->group(function(){
            Route::post('/', 'store')->name('store');
            Route::get('/list-by-auth-restaurant/{restaurant_id}', 'getByAuthRestaurant')->name('list.by.auth.restaurant')->whereNumber('restaurant_id');
        });
    });
    Route::controller(MenuitemController::class)->group(function(){
        Route::prefix('v1/menuitem')->name('menuitem.')->group(function(){
            Route::post('/', 'store')->name('store');
            Route::get('/list-by-auth-restaurant', 'getAllByAuthRestaurant')->name('list.by.restaurant');
            Route::get('/list-active-by-restaurant/{restaurant_id}', 'getAllActivesByRestaurant')->name('list.active.by.restaurant')->whereNumber('restaurant_id');
            Route::put('/', 'update')->name('update');
            Route::put('/is-active/{id}', 'toggleIsActive')->name('is.active')->whereNumber('id');
        });
    });

    Route::controller(AuthRestaurantController::class)->group(function() {
        Route::prefix('v1/auth-restaurant')->name('auth,restaurant')->group(function(){
            Route::post('/logout', 'logout')->name('logout');
        });
    });

    Route::controller(PromotionController::class)->group(function() {
        Route::prefix('v1/promotion')->name('promotion.')->group(function () {
            Route::get('/actives', 'listAllActives')->name('listall.actives');
        });
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::prefix('v1/category')->name('category.')->group(function () {
            Route::get('/actives', 'listAllActives')->name('listall.actives');
            Route::get('/uncreated-by-restaurant/{restaurant_id}', 'getAllNotBelongsToCurrentRestaurant')->name('listall.uncreated')->whereNumber('restaurant_id');
        });
    });

    Route::controller(FoodTypeController::class)->group(function(){
        Route::prefix('v1/food-type')->name('food.type.')->group(function(){
            Route::get('/uncreated-by-restaurant/{restaurant_id}', 'listAllUncreatedByRestaurant')->name('listall.uncreated')->whereNumber('restaurant_id');
        });
    });

    Route::controller(RestaurantFoodTypeController::class)->group(function(){
        Route::prefix('v1/restaurant-food-type')->name('restaurant_food_type.')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show')->whereNumber('id');
            Route::get('/list-by-restaurant/{restaurant_id}', 'listByRestaurant')->name('bt-restaurant')->whereNumber('restauarnt_id');
            Route::delete('/{id}', 'delete')->name('delete')->whereNumber('id');
            Route::put('/is-active/{id}', 'handleToggleIsActive')->name('toggle.isactive')->whereNumber('id');
        });
    });

    Route::controller(RestaurantCategoryController::class)->group(function() {
        Route::prefix('v1/restaurant-category')->name('restaurant-category.')->group(function() {
            Route::post('/', 'store')->name('store');
            Route::get('/', 'index')->name('index');
            Route::get('/list-by-restaurant/{restaurant_id}', 'getByRestaurant')->name('list.by.restaurant')->whereNumber('restaurant_id');
            Route::delete('/{id}', 'delete')->name('delete')->whereNumber('id');
            Route::put('/is-active/{id}', 'handleToggleIsActive')->name('toggle.isactive')->whereNumber('id');
        });
    });

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
        Route::get('/{id}', 'show')->name('show');
        Route::put('/', 'update')->name('update');
        Route::put('/status/{id}', 'handleIsActive')->name('update.status');
    });
});

Route::controller(RestaurantController::class)->group(function() {
    Route::prefix('v1/restaurant')->name('restaurant.')->group(function(){
        Route::post('/', 'store')->name('store');
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show')->whereNumber('id');
        Route::put('/', 'update')->name('update');
        Route::get('/actives', 'getAllActives')->name('actives');
    });
});
Route::controller(MenuitemController::class)->group(function(){
    Route::prefix('v1/menuitem')->name('menuitem.')->group(function(){
        Route::get('/list-active-by-restaurant/{restaurant_id}', 'getAllActivesByRestaurant')->name('list.active.by.restaurant')->whereNumber('restaurant_id');
        Route::get('/{id}', 'show')->name('show')->whereNumber('id');
        Route::get('/list-by-restaurant-food-type/{restaurant_food_type_id}', 'getAllByRestaurantFoodType')->name('list.by.restaurant.food.type')->whereNumber('restaurant_food_type_id');
    });
});

Route::controller(RestaurantFoodTypeController::class)->group(function(){
    Route::prefix('v1/restaurant-food-type')->name('restaurant_food_type.')->group(function () {
        Route::get('/list-by-restaurant/{restaurant_id}', 'listByRestaurant')->name('list.by.restaurant')->whereNumber('restauarnt_id');
        Route::get('/list-by-restaurant/has-menuitems/{restaurant_id}', 'listAllByRestaurantHasMenuitems')->name('list.all.by.restaurant-has-menuitems')->whereNumber('restaurant_id');
    });
});

Route::controller(AuthRestaurantController::class)->group(function() {
    Route::prefix('v1/auth-restaurant')->name('auth,restaurant')->group(function(){
        Route::post('/auth', 'login')->name('login');
    });
});
