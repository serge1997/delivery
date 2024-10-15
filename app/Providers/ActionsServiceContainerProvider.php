<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
