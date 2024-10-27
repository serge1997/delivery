<?php
namespace App\Main\RestaurantFoodType\Repository;

use App\Models\Restaurant;

interface RestaurantFoodTypeRepositoryInterface
{
    public function create($request, Restaurant $restaurant);
    public function findByRestaurantId(int $id);
}
