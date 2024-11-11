<?php
namespace App\Main\Menuitem\Repository;

use App\Models\Menuitem;
use App\Models\RestaurantFoodType;

interface MenuitemRepositoryInterface
{
    public function create($request);
    public function find(int $id) : Menuitem;
    public function findAllByAuthRestaurant(int $restaurant_id);
    public function findAllActivesByRestaurant(int $restaurant_id);
    public function update(Menuitem $menuitem, $request);
    public function toggleIsActive(Menuitem $menuitem);
    public function findAllByRestaurantFoodType(RestaurantFoodType $restaurant_food_type);
}
