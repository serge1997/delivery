<?php
namespace App\Main\RestaurantCategory\Actions;

use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;

class RestaurantCatgeoryCreate
{
    public function __construct(
        private RestaurantCategoryRepositoryInterface $restaurantCategoryRepository
    )
    {}
}