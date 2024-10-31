<?php
namespace App\Main\RestaurantCategory\Repository;

use App\Models\Restaurant;
use App\Models\RestaurantCategory;

interface RestaurantCategoryRepositoryInterface
{
    public function create($request, Restaurant $restaurant);
    public function findByRestaurantId(Restaurant $restaurantId);
    public function find(int $id);
    public function entityExist(int $restaurant_id, int $category_id) : bool;
    public function delete(RestaurantCategory $restaurantCategory);
    public function toggleIsActive(RestaurantCategory $restaurantCategory);
}
