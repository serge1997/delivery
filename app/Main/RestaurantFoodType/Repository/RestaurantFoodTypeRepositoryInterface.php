<?php
namespace App\Main\RestaurantFoodType\Repository;

use App\Models\Restaurant;
use App\Models\RestaurantFoodType;

interface RestaurantFoodTypeRepositoryInterface
{
    public function create($request, Restaurant $restaurant);
    public function findByRestaurantId(int $id);
    public function find(int $id);
    public function delete(RestaurantFoodType $restaurantFoodType);
    public function handleToggleIsActive(RestaurantFoodType $restaurantFoodType);
}
