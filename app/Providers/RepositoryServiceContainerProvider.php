<?php

namespace App\Providers;

use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepository;
use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepositoryInterface;
use App\Main\Category\Repository\CategoryRepository;
use App\Main\Category\Repository\CategoryRepositoryInterface;
use App\Main\FoodType\Repository\FoodTypeRepository;
use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;
use App\Main\Promotion\Repository\PromotionRepository;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;
use App\Main\Restaurant\Repository\RestaurantRepository;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FoodTypeRepositoryInterface::class, FoodTypeRepository::class);
        $this->app->bind(RestaurantRepositoryInterface::class, RestaurantRepository::class);
        $this->app->bind(AuthRestaurantRepositoryInterface::class, AuthRestaurantRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
