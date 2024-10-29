<?php
namespace App\Main\RestaurantCategory\Repository;

use App\Models\Restaurant;

interface RestaurantCategoryRepositoryInterface
{
    public function create($request, Restaurant $restaurant);
    public function findByRestaurantId(Restaurant $restaurantId);
    public function entityExist(int $restaurant_id, int $category_id) : bool;
}
