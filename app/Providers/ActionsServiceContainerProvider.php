<?php

namespace App\Providers;

use App\Main\Category\Actions\CategoryCreate;
use App\Main\Category\Actions\CategoryList;
use App\Main\Category\Actions\CategoryUpdate;
use App\Main\FoodType\Actions\FoodTypeCreate;
use App\Main\FoodType\Actions\FoodTypeList;
use App\Main\Promotion\Actions\PromotionCreate;
use App\Main\Promotion\Actions\PromotionList;
use App\Main\Promotion\Actions\PromotionUpdate;
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


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
