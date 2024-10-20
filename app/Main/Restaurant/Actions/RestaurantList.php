<?php
namespace App\Main\Restaurant\Actions;

use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;

class RestaurantList
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository
    ){}
}
