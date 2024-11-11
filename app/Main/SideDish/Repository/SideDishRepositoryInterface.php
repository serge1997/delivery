<?php
namespace App\Main\SideDish\Repository;

use App\Models\Restaurant;
use App\Models\SideDish;

interface SideDishRepositoryInterface
{

    public function create($request) : SideDish;
    public function findAllByAuthRestaurant(int $restaurant_id);
    public function findByRestaurantAndName(string $name, Restaurant $restaurant) : ?SideDish;
    public function find(int $id) : SideDish;
}
