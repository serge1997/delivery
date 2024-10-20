<?php
namespace App\Main\Restaurant\Actions;

use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;

class RestaurantCreate
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}
}
