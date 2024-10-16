<?php

namespace App\Providers;

use App\Main\Category\Repository\CategoryRepository;
use App\Main\Category\Repository\CategoryRepositoryInterface;
use App\Main\Promotion\Repository\PromotionRepository;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
