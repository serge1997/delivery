<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeCreate
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository
    )
    {}
}
