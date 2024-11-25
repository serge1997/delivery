<?php

namespace App\Providers;

use App\Main\Auth\Customer\Repository\AuthCustomerRepository;
use App\Main\Auth\Customer\Repository\AuthCustomerRepositoryInterface;
use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepository;
use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepositoryInterface;
use App\Main\Category\Repository\CategoryRepository;
use App\Main\Category\Repository\CategoryRepositoryInterface;
use App\Main\Customer\Repository\CustomerRepository;
use App\Main\Customer\Repository\CustomerRepositoryInterface;
use App\Main\FoodType\Repository\FoodTypeRepository;
use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;
use App\Main\Menuitem\Repository\MenuitemRepository;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepository;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;
use App\Main\Promotion\Repository\PromotionRepository;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;
use App\Main\Restaurant\Repository\RestaurantRepository;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepository;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepository;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;
use App\Main\SideDish\Repository\SideDishRepository;
use App\Main\SideDish\Repository\SideDishRepositoryInterface;
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
        $this->app->bind(RestaurantFoodTypeRepositoryInterface::class, RestaurantFoodTypeRepository::class);
        $this->app->bind(RestaurantCategoryRepositoryInterface::class, RestaurantCategoryRepository::class);
        $this->app->bind(MenuitemRepositoryInterface::class, MenuitemRepository::class);
        $this->app->bind(SideDishRepositoryInterface::class, SideDishRepository::class);
        $this->app->bind(MenuitemSideDishRepositoryInterface::class, MenuitemSideDishRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(AuthCustomerRepositoryInterface::class, AuthCustomerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
