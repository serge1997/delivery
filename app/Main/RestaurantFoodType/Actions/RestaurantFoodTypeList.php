<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeList
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository
    ){}

    public function listAll()
    {

    }
}
