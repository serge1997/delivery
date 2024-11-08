<?php
namespace App\Main\SideDish\Repository;

use App\Models\Restaurant;
use App\Models\SideDish;

class SideDishRepositoryInterface
{

    public function create($request) : SideDish;
    public function findAllByRestaurant(int $restaurant_id);
    public function findByRestaurantAndName(string $name, Restaurant $restaurant) : ?SideDish;
}
