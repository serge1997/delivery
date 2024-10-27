<?php

namespace App\Providers;

use App\Main\Auth\Restaurant\Actions\AuthRestaurantLogin;
use App\Main\Category\Actions\CategoryCreate;
use App\Main\Category\Actions\CategoryList;
use App\Main\Category\Actions\CategoryUpdate;
use App\Main\FoodType\Actions\FoodTypeCreate;
use App\Main\FoodType\Actions\FoodTypeList;
use App\Main\FoodType\Actions\FoodTypeUpdate;
use App\Main\Promotion\Actions\PromotionCreate;
use App\Main\Promotion\Actions\PromotionList;
use App\Main\Promotion\Actions\PromotionUpdate;
use App\Main\Restaurant\Actions\RestaurantCreate;
use App\Main\Restaurant\Actions\RestaurantList;
use App\Main\Restaurant\Actions\RestaurantUpdate;
use App\Main\RestaurantFoodType\Actions\RestaurantFoodTypeCreate;
use App\Main\RestaurantFoodType\Actions\RestaurantFoodTypeDelete;
use App\Main\RestaurantFoodType\Actions\RestaurantFoodTypeList;
use Illuminate\Support\ServiceProvider;

class ActionsServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PromotionCreate::class, PromotionCreate::class);
        $this->app->bind(PromotionList::class, PromotionList::class);
        $this->app->bind(PromotionUpdate::class, PromotionUpdate::class);
        $this->app->bind(CategoryCreate::class, CategoryCreate::class);
        $this->app->bind(CategoryList::class, CategoryList::class);
        $this->app->bind(CategoryUpdate::class, CategoryUpdate::class);
        $this->app->bind(FoodTypeCreate::class, FoodTypeCreate::class);
        $this->app->bind(FoodTypeList::class, FoodTypeList::class);
        $this->app->bind(FoodTypeUpdate::class, FoodTypeUpdate::class);
        $this->app->bind(RestaurantCreate::class, RestaurantCreate::class);
        $this->app->bind(RestaurantList::class, RestaurantList::class);
        $this->app->bind(RestaurantUpdate::class, RestaurantUpdate::class);
        $this->app->bind(AuthRestaurantLogin::class, AuthRestaurantLogin::class);
        $this->app->bind(RestaurantFoodTypeCreate::class, RestaurantFoodTypeCreate::class);
        $this->app->bind(RestaurantFoodTypeList::class, RestaurantFoodTypeList::class);
        $this->app->bind(RestaurantFoodTypeDelete::class, RestaurantFoodTypeDelete::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
